<?php

namespace App\Http\Controllers\money;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ReportMoneyController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $from = now()->firstOfMonth();
            $to = now()->endOfMonth();

            if (request('start') && request('end')) {
                $from = Carbon::parse(request('start'));
                $to = Carbon::parse(request('end') . " 23:59:59");
            }

            // Danh sách thu nhập, chi phí chi tiết
            $expensesList = $this->list_detail($this->db_table_expense($from, $to), 'expense_cate', 'payment_date');
            $incomesList = $this->list_detail($this->db_table_income($from, $to), 'income_cate', 'received_date');

            // Tổng thu nhập và chi phí
            $expensesTotal = $this->sum_vnd($this->db_table_expense($from, $to));
            $incomesTotal = $this->sum_vnd($this->db_table_income($from, $to));

            // Lợi nhuận
            $profit = $incomesTotal - $expensesTotal;

            // Danh sách thu nhập, chi phí theo loại
            $groupedExpenses = $this->list_type_group_expense($this->db_table_expense($from, $to));
            $groupedIncomes = $this->list_type_group_income($this->db_table_income($from, $to));

            // Check số ngày chênh lệch giữa 2 time
            $diffDay = $from->diffInDays($to);

            // Tạo dữ liệu biểu đồ
            $update_chart_expense = $this->update_chart($this->db_table_expense($from, $to), 'payment_date', $diffDay);
            $update_chart_income = $this->update_chart($this->db_table_income($from, $to), 'received_date', $diffDay);
            $chart_data_expense = $update_chart_expense->pluck('data', 'axis');
            $chart_axis_expense = $update_chart_expense->pluck('axis');
            $chart_data_income = $update_chart_income->pluck('data', 'axis');
            $chart_axis_income = $update_chart_income->pluck('axis');

            // Gộp giá trị 2 mảng và sắp xếp tăng dần
            $axis = collect([$chart_axis_expense, $chart_axis_income])->collapse()->sort()->values()->all();
            $data_char_expense = $this->convert_data_chart($axis, $chart_axis_expense, $chart_data_expense);
            $data_char_income = $this->convert_data_chart($axis, $chart_axis_income, $chart_data_income);

            // Tạo giá trị cao nhất của biểu đồ và chia giá trị
            $arr_value_axis = collect([$data_char_expense, $data_char_income])->collapse()->values();
            $max_axis = $arr_value_axis->max();
            $min_axis = $arr_value_axis->avg();


            // Đổ giá trị biểu đồ
            $profitChart = $this->chart_line($data_char_expense, $data_char_income, $axis, $max_axis, $this->stepSize($max_axis));
            $expenseChart = $this->chart_bar_expense();
            $incomeChart = $this->chart_bar_income();

            // So sánh cùng kỳ năm trước
            $lastYearExpenses = $this->db_table_expense($from->subYear(), $to->subYear());
            $lastYearIncomes = $this->db_table_income($from->subYear(), $to->subYear());

            // Tổng cùng kỳ năm trước
            $lastYearExpensesTotal = $this->sum_vnd($lastYearExpenses);
            $lastYearIncomesTotal = $this->sum_vnd($lastYearIncomes);

            // Lợi nhuận cùng kỳ năm trước
            $lastYearProfit = $lastYearIncomesTotal - $lastYearExpensesTotal;

            // Chênh lệch giữa hiện tại và năm trước
            $differenceExpenses = $expensesTotal - $lastYearExpensesTotal;
            $differenceIncomes = $incomesTotal - $lastYearIncomesTotal;
            $differenceProfit = $profit - $lastYearProfit;

            // % tăng hoặc giảm so với năm trước
            $percentExpenses = $lastYearExpensesTotal === 0 ? 100 : ($differenceExpenses / $lastYearExpensesTotal) * 100;
            $percentIncomes = $lastYearIncomesTotal === 0 ? 100 : ($differenceIncomes / $lastYearIncomesTotal) * 100;
            $percentProfit = $lastYearProfit === 0 ? 100 : ($differenceProfit / $lastYearProfit) * 100;


            return response()->view('admin.money.content_report', [
                'data_line' => $update_chart_expense,
                'value' => $min_axis,
                'month' => $axis,
                'profitChart' => $profitChart,
                'expenseChart' => $expenseChart,
                'incomeChart' => $incomeChart,
                'expenses' => $expensesList,
                'incomes' => $incomesList,
                'expensesSummary' => $groupedExpenses,
                'incomesSummary' => $groupedIncomes,
                'expensesTotal' => number_format($expensesTotal, 0, ',', '.'),
                'incomesTotal' => number_format($incomesTotal, 0, ',', '.'),
                'profit' => number_format($profit, 0, ',', '.'),
                'differenceExpenses' => number_format($differenceExpenses, 0, ',', '.'),
                'differenceIncomes' => number_format($differenceIncomes, 0, ',', '.'),
                'differenceProfit' => number_format($differenceProfit, 0, ',', '.'),
                'percentExpenses' => number_format($percentExpenses, 2, ',', '.'),
                'percentIncomes' => number_format($percentIncomes, 2, ',', '.'),
                'percentProfit' => number_format($percentProfit, 2, ',', '.')
            ]);
        } else {
            return view('admin.money.report', [
                'title' => 'Financial Reports'
            ]);
        }
    }

    public function db_table_expense($from, $to): Builder
    {
        return DB::table('expenses')->whereBetween('payment_date', [$from, $to]);
    }

    public function db_table_income($from, $to): Builder
    {
        return DB::table('incomes')->whereBetween('received_date', [$from, $to]);
    }

    public function sum_vnd($table)
    {
        return $table->sum('amount_vnd');
    }

    public function list_detail($table, $select1, $select2)
    {
        return $table->select($select1, $select2, 'amount_vnd', 'amount_usd', 'rate')->orderBy($select2)->get();
    }

    public function list_type_group_expense($table)
    {
        return $table->Join('expense_categories', 'expense_cate', '=', 'expense_categories.id')
            ->select('expenses.expense_cate', 'expense_categories.name', DB::raw('sum(expenses.amount_vnd) AS expense_sum_type'))
            ->groupBy('expenses.expense_cate')->orderBy('expense_sum_type', 'desc')->get();

    }

    public function list_type_group_income($table)
    {
        return $table->Join('income_categories', 'income_cate', '=', 'income_categories.id')
            ->select('incomes.income_cate', 'income_categories.name', DB::raw('sum(incomes.amount_vnd) AS income_sum_type'))
            ->groupBy('incomes.income_cate')->orderBy('income_sum_type', 'desc')->get();
    }

    public function update_chart($table, $col_filter, $diffDay)
    {
        switch (request('type')) {
            case ('Today'):
            case ('Yesterday'):
                $chart = $this->show_hour($table, $col_filter);
                break;
            case ('Last 7 Days'):
            case ('Last 30 Days'):
            case ('Last Month'):
            case ('This Month'):
                $chart = $this->show_day($table, $col_filter);
                break;
            default:
                if ($diffDay === 1) {
                    $chart = $this->show_hour($table, $col_filter);
                } else if ($diffDay < 60) {
                    $chart = $this->show_day($table, $col_filter);
                } else {
                    $chart = $table->select(DB::raw('sum(amount_vnd) as data'), DB::raw("DATE_FORMAT($col_filter, '%m/%Y') axis"))->groupBy('axis')->get();
                }

                break;
        }

        return $chart;
    }

    public function show_hour($table, $col_filter)
    {
        return $table->select(DB::raw('sum(amount_vnd) as data'), DB::raw("DATE_FORMAT($col_filter, '%H') axis"))->groupBy('axis')->get();
    }

    public function show_day($table, $col_filter)
    {
        return $table->select(DB::raw('sum(amount_vnd) as data'), DB::raw("DATE_FORMAT($col_filter, '%d/%m') axis"))->groupBy('axis')->get();
    }

    public function convert_data_chart($axis, $chart_axis, $chart_data): array
    {
        $collection = collect($axis)->diff($chart_axis)->values()->all();
        foreach ($collection as $item) {
            $chart_data[$item] = "0";
        }

        return collect([json_decode($chart_data, true)])->collapse()->sortKeys()->values()->all();
    }

    public function stepSize($max_axis): int
    {
        switch ($max_axis) {
            case ($max_axis <= 50000):
                $stepSize = 10000;
                break;
            case ($max_axis <= 100000):
                $stepSize = 20000;
                break;
            case ($max_axis <= 500000):
                $stepSize = 100000;
                break;
            case ($max_axis <= 1000000):
                $stepSize = 200000;
                break;
            default:
                $stepSize = 0;
        }

        return $stepSize;
    }

    public function chart_line($data_expense, $data_income, $axis, $max_axis, $ticks): string
    {
        return '"type": "line",
            "data": {
                "labels": ' . json_encode($axis) . ',
                "datasets": [{
                    "label": "Income",
                    "data": ' . json_encode($data_income) . ',
                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                    "borderColor": "#377dff",
                    "borderWidth": 2,
                    "pointRadius": 0,
                    "pointBorderColor": "#fff",
                    "pointBackgroundColor": "#377dff",
                    "pointHoverRadius": 0,
                    "hoverBorderColor": "#fff",
                    "hoverBackgroundColor": "#377dff"
                    },
                    {
                        "label": "Expenses",
                        "data": ' . json_encode($data_expense) . ',
                        "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                        "borderColor": "#FF0000",
                        "borderWidth": 2,
                        "pointRadius": 0,
                        "pointBorderColor": "#fff",
                        "pointBackgroundColor": "#FF0000",
                        "pointHoverRadius": 0,
                        "hoverBorderColor": "#fff",
                        "hoverBackgroundColor": "#FF0000"
                    }
                ]
            },
            "options": {
                "gradientPosition": {"y1": 200},
                "scales": {
                    "yAxes": [{
                        "gridLines": {
                            "color": "#e7eaf3",
                            "drawBorder": false,
                            "zeroLineColor": "#e7eaf3"
                        },
                        "ticks": {
                            "min": 0,
                            ' . (($max_axis <= 1000000) ? '"stepSize": ' . $ticks . ',' : '') . '
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 10
                        }
                    }],
                    "xAxes": [{
                        "gridLines": {
                            "display": false,
                            "drawBorder": false
                        },
                        "ticks": {
                            "fontSize": 12,
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 5
                        }
                    }]
                },
                "hover": {
                    "mode": "nearest",
                    "intersect": true
                },
                "legend": {
                    "align": "end",
                    "display": true,
                    "labels": {
                        "padding": 15,
                        "usePointStyle": true
                    }
                }
            }';
    }

    public function chart_bar_expense($data_expense, $data_expense_last_year, $label, $max_axis, $ticks): string
    {
        return '"type": "bar",
            "data": {
                "labels": ' . json_encode($label) . ',
                "datasets": [{
                    "label": "Expense",
                    "data": ' . json_encode($data_expense) . ',
                    "backgroundColor": ["rgba(55, 125, 255, 0)", "rgba(255, 255, 255, 0)"],
                    "borderColor": "#377dff",
                    "borderWidth": 2,
                    "pointRadius": 0,
                    "pointBorderColor": "#fff",
                    "pointBackgroundColor": "#377dff",
                    "pointHoverRadius": 0,
                    "hoverBorderColor": "#fff",
                    "hoverBackgroundColor": "#377dff"
                },
                    {
                        "label": "Last Year",
                        "data": ' . json_encode($data_expense_last_year) . ',
                        "backgroundColor": ["rgba(0, 201, 219, 0)", "rgba(255, 255, 255, 0)"],
                        "borderColor": "#FF0000",
                        "borderWidth": 2,
                        "pointRadius": 0,
                        "pointBorderColor": "#fff",
                        "pointBackgroundColor": "#00c9db",
                        "pointHoverRadius": 0,
                        "hoverBorderColor": "#fff",
                        "hoverBackgroundColor": "#00c9db"
                    }]
            },
            "options": {
                "gradientPosition": {"y1": 200},
                "scales": {
                    "yAxes": [{
                        "gridLines": {
                            "color": "#e7eaf3",
                            "drawBorder": false,
                            "zeroLineColor": "#e7eaf3"
                        },
                        "ticks": {
                            "min": 0,
                           ' . (($max_axis <= 1000000) ? '"stepSize": ' . $ticks . ',' : '') . '
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 10,
                            "postfix": "k"
                        }
                    }],
                    "xAxes": [{
                        "gridLines": {
                            "display": false,
                            "drawBorder": false
                        },
                        "ticks": {
                            "fontSize": 12,
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 5
                        }
                    }]
                },
                "tooltips": {
                    "prefix": "$",
                    "postfix": "k",
                    "hasIndicator": true,
                    "mode": "index",
                    "intersect": false,
                    "lineMode": true,
                    "lineWithLineColor": "rgba(19, 33, 68, 0.075)"
                },
                "hover": {
                    "mode": "nearest",
                    "intersect": true
                },
                "legend": {
                    "align": "end",
                    "display": true
                }
            }';
    }

    public function chart_bar_income($data_income ahihi, $data_income_last_year, $axis, $max_axis, $ticks): string
    {
        return '"type": "bar",
            "data": {
                "labels": ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10"],
                "datasets": [{
                    "data": [200, 300, 290, 350, 150, 350, 300, 100, 125, 220],
                    "backgroundColor": "#377dff",
                    "hoverBackgroundColor": "#377dff",
                    "borderColor": "#377dff"
                },
                    {
                        "data": [150, 230, 382, 204, 169, 290, 300, 100, 300, 225, 120],
                        "backgroundColor": "#e7eaf3",
                        "borderColor": "#e7eaf3"
                    }]
            },
            "options": {
                "scales": {
                    "yAxes": [{
                        "gridLines": {
                            "color": "#e7eaf3",
                            "drawBorder": false,
                            "zeroLineColor": "#e7eaf3"
                        },
                        "ticks": {
                            "beginAtZero": true,
                            "stepSize": 100,
                            "fontSize": 12,
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 10,
                            "postfix": "$"
                        }
                    }],
                    "xAxes": [{
                        "gridLines": {
                            "display": false,
                            "drawBorder": false
                        },
                        "ticks": {
                            "fontSize": 12,
                            "fontColor": "#97a4af",
                            "fontFamily": "Open Sans, sans-serif",
                            "padding": 5
                        },
                        "categoryPercentage": 0.5,
                        "maxBarThickness": "10"
                    }]
                },
                "cornerRadius": 2,
                "tooltips": {
                    "prefix": "$",
                    "hasIndicator": true,
                    "mode": "index",
                    "intersect": false
                },
                "hover": {
                    "mode": "nearest",
                    "intersect": true
                }
            }';
    }
}
