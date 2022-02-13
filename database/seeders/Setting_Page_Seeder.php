<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Setting_Page_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config_page')->insert([
            [
                'config_key' => 'phone',
                'config_value' => '0349368866'
            ],
            [
                'config_key' => 'email',
                'config_value' => 'support@tribeidol.com'
            ],
            [
                'config_key' => 'telegram',
                'config_value' => 'Tkank95'
            ],
            [
                'config_key' => 'deadline_home',
                'config_value' => '2021-09-20'
            ],
            [
                'config_key' => 'countdown_href_home',
                'config_value' => '#'
            ],
            [
                'config_key' => 'countdown_content_home',
                'config_value' => 'ĐĂNG KÝ LIVE STREAM NGAY HÔM NAY'
            ],
            [
                'config_key' => 'countdown_header_home',
                'config_value' => '<h1 class="animated" data-animate="fadeInUp" data-delay="0.65">Welcome to
                                            Team Tribe</h1>
                                        <p class="lead animated" data-animate="fadeInUp" data-delay="0.75">
                                            Livestream kiếm tiền online 4.0 <br class="d-none d-md-block"/> bạn sẽ làm
                                            được</p>'
            ],
            [
                'config_key' => 'countdown_href_tutorial_home',
                'config_value' => '#'
            ],
            [
                'config_key' => 'countdown_href_video_home',
                'config_value' => '#'
            ],
            [
                'config_key' => 'about_block1_home',
                'config_value' => '<h6 class="heading-sm-s2 animated" data-animate="fadeInUp" data-delay=".2">Các
                                    ứng dụng livestream
                                </h6>
                                <h2 class="animated" data-animate="fadeInUp" data-delay=".3">TRIBE TUYỂN DỤNG
                                </h2>
                                <h5 class="lead animated" data-animate="fadeInUp" data-delay=".4">
                                    <strong>LIVE GIẢI TRÍ</strong>
                                </h5>
                                <p class="animated" data-animate="fadeInUp" data-delay=".5">Live một hoặc nhiều
                                    nội dụng như: Hát, Múa, Mai Mối (Ghép đôi, tư vấn tình cảm, &#8230;), Ăn
                                    uống Outdoor (Hoạt động ngoài trời), Sexy dance, DJ, Bài Tarot, Cosplay,
                                    Make up, Nhạc cụ, MC, Đọc truyện, Kể truyện, Thú cưng, Múa cột, Ảo thuật,
                                    RAP, Vẽ, Trò chuyện, Hài hước, Xiếc, Xăm hình, Viết chữ thư pháp, Thể thao
                                    (Yoga, tập Gym, &#8230;), Nấu Ăn, hoặc các nội dung khác &#8230;
                                </p>
                                <p class="animated" data-animate="fadeInUp" data-delay=".6">Các ứng dụng lương
                                    cứng từ 50 &#8211; 500$/tháng, không yêu cầu chỉ tiêu quà và yêu cầu
                                    casting: <strong>HAGO, MICO, ELELIVE.</strong>
                                </p>
                                <p class="animated" data-animate="fadeInUp" data-delay=".7">Ứng dụng lương theo
                                    chỉ tiêu quà từ 40 &#8211; 60.000$/tháng và không casting:
                                    <strong>BIGO</strong>
                                </p>
                                <h5 class="lead animated" data-animate="fadeInUp" data-delay=".8"><strong>LIVE
                                        GAME</strong>
                                </h5>
                                <p class="animated" data-animate="fadeInUp" data-delay=".9">Live một hoặc nhiều
                                    game như: Liên quân moblie, Pubg Mobile, Free fire, Liên minh tốc chiến,
                                    &#8230;
                                </p>
                                <p class="animated" data-animate="fadeInUp" data-delay=".10">Lương cứng khởi
                                    điểm là 40$ và yêu cầu casting live trên app để xét chỉ số người xem và quà
                                    tặng: <strong>NONOLIVE, BIGO LIVE</strong>
                                </p>'
            ],
            [
                'config_key' => 'about_block2_home',
                'config_value' => '<h6 class="heading-sm-s2 animated" data-animate="fadeInUp" data-delay=".2">Tại
                                        sao lại chọn nghề " Idol Livestream " ?
                                    </h6>
                                    <h2 class="animated" data-animate="fadeInUp" data-delay=".3">Thu nhập cao</h2>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".4">Livestream đang ngày
                                        càng phát triển và là xu hướng mới.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".5">Công việc nhẹ nhàng,
                                        không tốn quá nhiều sức lực.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".6">Thỏa mãn được đam mê
                                        , sở thích của bản thân.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".7">Thoải mái về thời
                                        gian, live tự do không gò bó.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".8">Thu nhập “có thể”
                                        cực cao 5-50 triệu/tháng hoặc hơn thế nữa.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".9">Đặc biệt là miễn
                                        phí, không cọc không phí.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".10">Được hỗ trợ từ team
                                        khi làm.</p>'
            ],
            [
                'config_key' => 'about_block3_home',
                'config_value' => '<h6 class="heading-sm-s2 animated" data-animate="fadeInUp" data-delay=".2">
                                        Để trở thành Idol Livestream bạn cần gì ?
                                    </h6>
                                    <h2 class="animated" data-animate="fadeInUp" data-delay=".3">Tài năng và tự tin
                                    </h2>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".4">Bạn có khả năng ca hát hoặc nhảy hay năng khiếu chơi các nhạc cụ, hài hước, hay chỉ đơn giản là các tài lẻ mà bạn có: ảo thuật, cosplay, .....</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".5">Quan trọng nhất là sự tin tin thể hiện tài năng của bạn.</p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".6"> Nếu bạn không có 1 trong các yếu tố trên thì “tài năng” về ngoại hình của bạn sẽ bù đắp được .Ngoại hình ưa nhìn và cách nói chuyện thu hút, lôi cuốn chính là tài năng của bạn.</p>
                                '
            ],
            [
                'config_key' => 'about_block4_home',
                'config_value' => '<h6 class="heading-sm-s2 animated" data-animate="fadeInUp" data-delay=".2">
                                        Để trở thành Idol Livestream bạn cần gì ?
                                    </h6>
                                    <h2 class="animated" data-animate="fadeInUp" data-delay=".3">Cơ sở vật chất và tinh thần</h2>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".4">Có máy tính hoặc điện thoại kết nối internet.
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".5">Ánh sáng và Background đẹp, nếu không có thì có thể dùng các bức tường trắng.
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".6">Webcam và mic trên máy tính để phát sóng trực tiếp, điện thoại thì không cần dùng công cụ đó.
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".7">Mong muốn phát triển bản thân
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".8">Yêu thích giao tiếp với mọi người.
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".9">Muốn kiếm thêm thu nhập từ livestream.
                                    </p>
                                    <p class="animated" data-animate="fadeInUp" data-delay=".10">Chăm chỉ, chịu khó, không ngại khó khăn.
                                    </p>
                                    <h6 class="animated" data-animate="fadeInUp" data-delay=".11">Nếu bạn tự tin để thể hiện tài năng và có một vài hoặc tất cả điều kiện trên thì bạn có thể trở thành Idol Livestream ngay hôm nay.
                                    </h6>'
            ]
        ]);
    }
}
