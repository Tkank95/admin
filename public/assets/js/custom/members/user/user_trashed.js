$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // INITIALIZATION OF DATATABLES
    // =======================================================
    let datatable = $.HSCore.components.HSDatatables.init($('#datatable'), {
        processing: true,
        serverSide: true,
        autoWidth: false,
        pageLength: 5,
        deferRender: true,
        stateSave: true,
        order: [],
        info: {"totalQty": "#datatableWithPaginationInfoTotalQty"},
        search: "#datatableSearch",
        entries: "#datatableEntries",
        isResponsive: true,
        isShowPaging: false,
        pagination: "datatablePagination",
        // scrollX: true,
        columnDefs: [{
            targets: 0,
            searchable: false,
            orderable: false,
            className: 'table-column-pr-0',
            render: function (data, type, row) {
                return '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input checkbox"' +
                    'name="' + row.id + '" id="' + row.id + '"><label class="custom-control-label" for="' + row.id + '"></label></div>';
            }
        }],
        ajax: 'trashed/user/get',
        columns: [
            {data: 'id', name: 'id'},
            {
                render: function (data, type, row) {
                    return '<a data-fancybox="single" href="' + row.avatar + '" class="media align-items-center"><div class="avatar avatar-circle mr-3">' +
                        '<img class="avatar-img" src="' + row.avatar + '" alt="Image Description"></div>' +
                        '<div class="media-body"><span class="d-block h5 text-hover-primary mb-0"> ' + row.name + ' </span>' +
                        '<span class="d-block font-size-sm text-body">' + row.email + '</span></div></a>';
                }
            },
            {data: 'username', name: 'username'},
            {data: 'id',
                render: function (data) {
                    return '<span class="btn btn-primary btn-xs" data-id="' + data + '">View</span>';
                }
            },
            {data: 'id',
                render: function (data) {
                    return '<span class="btn btn-primary btn-xs" data-id="' + data + '">View</span>';                }
            },
            {data: 'id',
                render: function (data) {
                    return '<span class="btn btn-primary btn-xs" data-id="' + data + '">View</span>';                }
            },
            {data: 'id',
                render: function (data) {
                    return '<span class="btn btn-primary btn-xs" data-id="' + data + '">View</span>';                }
            },
            {data: 'id',
                render: function (data) {
                    return '<span class="btn btn-primary btn-xs" data-id="' + data + '">View</span>';                }
            },
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data, type, row) {
                    return moment(data).format("DD-MM-YYYY HH:mm:ss");
                }
            },
            {
                data: 'deleted_at',
                name: 'deleted_at',
                render: function (data, type, row) {
                    return moment(data).format("DD-MM-YYYY HH:mm:ss");
                }
            },
            {data: 'Actions', name: 'Actions', orderable: false, serachable: false, sClass: 'text-center'},
        ],
        language: {
            zeroRecords: '<div class="text-center p-4">' +
                '<img class="mb-3" src="/assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
                '<p class="mb-0">No data to show</p>' +
                '</div>'
        },
        select: {
            style: 'multi',
            selector: 'td:first-child input[type="checkbox"]',
            classMap: {
                checkAll: '#datatableCheckAll',
                counter: '#datatableCounter',
                counterInfo: '#datatableCounterInfo'
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                className: 'd-none',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'excelHtml5',
                className: 'd-none',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'csv',
                className: 'd-none',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'pdfHtml5',
                className: 'd-none',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            {
                extend: 'print',
                className: 'd-none',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
        ],
    });

    // XUẤT DATA BẢNG
    $('#export-copy').click(function () {
        datatable.button('.buttons-copy').trigger()
    });

    $('#export-excel').click(function () {
        datatable.button('.buttons-excel').trigger()
    });

    $('#export-csv').click(function () {
        datatable.button('.buttons-csv').trigger()
    });

    $('#export-pdf').click(function () {
        datatable.button('.buttons-pdf').trigger()
    });

    $('#export-print').click(function () {
        datatable.button('.buttons-print').trigger()
    });
    // END XUẤT DATAT BẢNG

    // INITIALIZATION OF SELECT2
    // =======================================================
    $('.js-select2-custom').each(function () {
        var select2 = $.HSCore.components.HSSelect2.init($(this));
    });

    // LỌC DỮ LIỆU BẢNG
    $('.js-datatable-filter').on('change', function () {
        var $this = $(this),
            elVal = $this.val(),
            targetColumnIndex = $this.data('target-column-index');

        datatable.column(targetColumnIndex).search(elVal).draw();
    });

    // TÌM KIẾM
    $('#datatableSearch').on('search', function () {
        datatable.search('').draw();
    });


    // Ẩn hiện column
    // =======================================================

    $('#name_user').change(function (e) {
        datatable.columns(1).visible(e.target.checked)
    })

    $('#gender_user').change(function (e) {
        datatable.columns(2).visible(e.target.checked)
    })

    $('#birth_day_user').change(function (e) {
        datatable.columns(3).visible(e.target.checked)
    })

    $('#phone_user').change(function (e) {
        datatable.columns(4).visible(e.target.checked)
    })

    $('#username_user').change(function (e) {
        datatable.columns(5).visible(e.target.checked)
    })

    $('#position_user').change(function (e) {
        datatable.columns(6).visible(e.target.checked)
    })

    $('#team_user').change(function (e) {
        datatable.columns(7).visible(e.target.checked)
    })

    $('#status_user').change(function (e) {
        datatable.columns(8).visible(e.target.checked)
    })

    $('#action_user').change(function (e) {
        datatable.columns(9).visible(e.target.checked)
    })
    // END UNFOLD COLUMN
    // =======================================================


    $('body').on('click', '.active_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        active_status(id, 'user/active/', 'Tài khoản người dùng')
    });

    $('body').on('click', '.deactive_status', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deactive_status(id, 'user/deactive/', 'Tài khoản người dùng')
    });

    $('body').on('click', '.deleteAll', function (event) {
        event.preventDefault();
        let idsArr = [];
        $(".checkbox:checked").each(function () {
            idsArr.push($(this).attr('id'));
        });
        deleteAll(idsArr, 'user/delete/', 'Tài khoản người dùng')
    });
});
