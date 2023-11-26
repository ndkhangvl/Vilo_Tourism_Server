<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('msg.introduction') }}</title>
    @include('/components.constraint')
    <style>
        .title_introduction {
            width: 100%;
            padding-right: 10%;
            padding-left: 10%;
            margin-right: auto;
            margin-left: auto;
        }

        .dotted-list {
            list-style-type: disc;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    @include('/components.header_home')
    <div class="title_introduction">
        <div class="container mx-auto">
            <h3 class="my-2 font-bold">Giới thiệu</h3>
            <div class="my-2 border-b"></div>
            <h4><strong>1. Vị trí địa lý</strong></h4>
            <p>Tỉnh Vĩnh Long nằm ở trung tâm vùng Đồng bằng sông Cửu Long, diện tích tự nhiên 1.525,73 km2.&nbsp;</p>
            <div class="pl-3">
                <ul class="dotted-list pl-3">
                    <li>Phía Bắc và Đông Bắc giáp các tỉnh Tiền Giang và Bến Tre;&nbsp;</li>
                    <li>Phía Tây Bắc Đông giáp tỉnh Đồng Tháp;&nbsp;</li>
                    <li>Phía Đông Nam giáp với tỉnh Trà Vinh;&nbsp;</li>
                    <li>Phía Tây Nam giáp các tỉnh Hậu Giang, Sóc Trăng và Thành phố Cần Thơ.</li>
                </ul>
            </div>
            <p>Tỉnh Vĩnh Long có 8 đơn vị hành chính, gồm 6 huyện (Bình Tân, Long Hồ, Mang Thít, Tam Bình, Trà Ôn, Vũng
                Liêm); thị xã Bình Minh và thành phố Vĩnh Long với 107&nbsp;đơn vị hành chính cấp xã, gồm 87 xã, 14
                phường và 06 thị trấn.</p>
            <img src="https://cdn.diaocthongthai.com/map/VNM/map_political_label_1/vnm__vinh_long.jpg" />
            <p class="text-center">
                <span class="text-base">
                    <em>
                        <span class="font-calibri bg-white">
                            <span class="font-segoe-ui text-black">Bản đồ hành chính Vĩnh Long (Ảnh bởi Địa ốc Thông
                                Thái)</span>
                        </span>
                    </em>
                </span>
            </p>
            <h4><strong>2. Dân số - lao động.</strong></h4>
            <p>Dân số trung bình toàn tỉnh năm 2022 ước đạt là 1.028.822 người (nam 508.715, nữ 520.107 người). Trong
                đó, khu vực thành thị có 233.940 người, chiếm 22.74%; khu vực nông thôn có 794.882 người, chiếm 77,26%.
            </p>
            <p>Vĩnh Long là tỉnh có cơ cấu đa dân tộc sinh sống, bao gồm người Kinh, người Khmer, Người Hoa,….. Theo
                thống kê năm 2019, Vĩnh Long có 24 dân tộc thiểu số sinh sống (26.596 người dân tộc thiểu số), chiếm
                2,6% dân số toàn tỉnh. Trong đó, người Khmer có 22.630 người chiếm 2,21% (nữ 11.717 người); người Hoa
                có&nbsp;3.627 người&nbsp;chiếm 0,35% (nữ 1.765 người); các dân tộc khác có&nbsp;339 người chiếm 0,03 %
                (nữ 201 người).&nbsp;Người Kinh phân bố đều ở các nơi; người Khmer sống tập trung ở 48 ấp, 10 xã và 01
                thị trấn thuộc 04 huyện Trà Ôn, Tam Bình, thị xã Bình Minh, Vũng Liêm; người Hoa tập trung ở thành phố
                Vĩnh Long và các thị trấn.</p>
            <p>Lực lượng lao động từ 15 tuổi trở lên của tỉnh&nbsp;năm 2022 đạt 582.943 người, trong đó lao động nam là
                316.896 người, chiếm 54,36%; lao động nữ là 266.047 người, chiếm 45,64%. Trong tổng số, lực lượng lao
                động khu vực thành thị là 126.534 người, chiếm 21,71%, khu vực nông thôn là 456.409 người, chiếm 78,29%.
            </p>
            <p>Lao động từ 15 tuổi trở lên đang làm việc trong các ngành kinh tế năm 2022 đạt 568.495 người, tính theo
                tiêu chuẩn&nbsp; ICLS19 (khung khái niệm mới tại Hội nghị quốc tế về thống kê lao động việc làm lần thứ
                19 được các quốc gia thống nhất sử dụng). Tỷ lệ lao động từ 15 tuổi trở lên đã qua đào tạo năm 2022 đạt
                16,46%, trong đó lao động đã qua đào tạo khu vực thành thị đạt 30,89%; khu vực nông thôn đạt 12.45%.</p>
            <h4><strong>3. Địa hình.</strong></h4>
            <p>Vĩnh Long có địa hình khá bằng phẳng với độ dốc nhỏ hơn 2 độ, cao trình khá thấp so với mực nước biển
                (cao trình tuyệt đối từ 0,6 đến 1,2m chiếm 90% diện tích tự nhiên), toàn tỉnh chỉ có khu vực thành phố
                Vĩnh Long và thị trấn Trà Ôn có độ cao trung bình khoảng 1,25m. Đây là dạng địa hình đồng bằng ngập lụt
                cửa sông, tiểu địa hình của tỉnh có dạng lòng chảo ở giữa trung tâm tỉnh và cao dần về 2 hướng bờ sông
                Tiền, sông Hậu, sông Mang Thít và ven các sông rạch lớn. Nhìn chung, địa thế của tỉnh trải rộng dọc theo
                sông Tiền và sông Hậu, thấp dần từ Bắc xuống Nam, chịu ảnh hưởng của nước mặn, lũ không lớn, có thể chia
                ra 3 cấp như sau:</p>
            <p>- Vùng có cao trình từ 1,0 đến 2,0m (chiếm 37,17% diện tích) ở ven sông Hậu, sông Tiền, sông Mang Thít,
                ven sông rạch lớn cũng như đất cù lao giữa sông và vùng đất giồng gò của huyện Vũng Liêm, Trà Ôn.</p>
            <p>- Vùng có cao trình từ 0,4 đến 1,0m (chiếm 61,53% diện tích) phân bố chủ yếu là đất 2-3 vụ lúa cao sản
                với tiềm năng tưới tự chảy khá lớn, năng suất cao, trong đó vùng phía Bắc quốc lộ 1A l chịu ảnh hưởng lũ
                tháng 8 hàng năm.</p>
            <p>- Vùng có cao trình nhỏ hơn 0,4m (chiếm 1,3% diện tích) có địa hình thấp trũng, ngập sâu.</p>
            <p>Với điều kiện địa hình này, trong tương lai khi BĐKH toàn cầu sẽ ảnh hưởng đến khu vực ĐBSCL nói chung và
                tỉnh Vĩnh Long nói riêng, BĐKH với kịch bản mực nước biển dâng 1m, qua tính toán sẽ có các huyện Vũng
                Liêm, Trà Ôn bị ảnh hưởng do nhiễm mặn và có khoảng 606 km2&nbsp;(gần 40% diện tích) đất ở khu vực trung
                tâm tỉnh bị ngập, ảnh hưởng đến sản xuất nông nghiệp; hoạt động nuôi trồng và đánh bắt thuỷ sản, ảnh
                hưởng đến cơ sở hạ tầng (hệ thống đường giao thông, các công trình xây dựng, nhà cửa,..); ảnh hưởng đến
                môi trường sống của người dân và môi trường sinh thái, ĐDSH của địa phương.</p>
            <h4><strong>4. Thời tiết - khí hậu - thủy văn</strong></h4>
            <p><i><strong>Thời tiết - khí hậu:&nbsp;</strong></i>Vĩnh Long nằm trong vùng nhiệt đới gió mùa, quanh năm
                nóng, ẩm, có chế độ nhiệt tương đối cao và bức xạ dồi dào.</p>
            <p>- Nhiệt độ: Nhiệt độ trung bình của tỉnh Vĩnh Long qua các năm biến động từ 27,3 – 28,4&nbsp;0C, trong đó
                cao nhất là năm 2010. Trong năm này, nhiệt độ trung bình các tháng xấp xỉ hoặc cao hơn trung bình nhiều
                năm từ 0,4-1,0oC. Nhiệt độ cao nhất là 36,9oC, thấp nhất là 17,7oC và biên độ nhiệt giữa ngày và đêm
                bình quân là 7,30oC.</p>
            <p>Bức xạ trên địa bàn tỉnh tương đối cao, bình quân số giờ nắng trong một ngày là 7,5 giờ. Bức xạ quang hợp
                hàng năm đạt 79.600 cal/m2. Thời gian chiếu sáng bình quân năm đạt 2.550-2.700 giờ/năm. Nhiệt độ và bức
                xạ dồi dào là điều kiện cho cây trồng sinh trưởng và phát triển tốt</p>
            <p>- Độ ẩm không khí bình quân 81-85%, trong tháng 9, độ ẩm đạt cao nhất là 90% và tháng thấp nhất là 74%
                (tháng 3,4).</p>
            <p>- Số ngày mưa bình quân trong năm là 100 – 115 ngày với lượng mưa trung bình 1.300 – 1.690 mm/năm. Lượng
                mưa ở mùa khô xấp xỉ và cao hơn trung bình nhiều năm nhưng lượng mưa mùa mưa lại xấp xỉ và thấp hơn
                trung bình nhiều năm. Nhìn chung, trong các tháng mùa mưa, lượng mưa tháng ở hầu hết các nơi trong tỉnh
                chỉ từ 35 - 50%, thấp hơn so với trung bình nhiều năm.</p>
            <p>Tỉnh Vĩnh Long qua các năm không có các dạng khí hậu cực đoan mặc dù ở một vài nơi có xuất hiện lốc xoáy,
                ngập lũ, sét đánh vào mùa mưa hoặc mưa trái mùa trên diện rộng, ảnh hưởng áp thấp nhiệt đới biển Đông
                gây mưa nhiều ngày.</p>
            <p><i><strong>Thuỷ văn:&nbsp;</strong></i>Tỉnh Vĩnh Long chịu ảnh hưởng chế độ bán nhật triều không đều của
                biển Đông thông qua 2 sông lớn là sông Tiền và sông Hậu cùng với sông Mang Thít và hệ thống kênh rạch.
                Cụ thể:</p>
            <p>- Sông Cổ Chiên là nhánh của sông Tiền, có chiều dài 90km, đoạn đi qua Vĩnh Long mặt cắt sông rộng trung
                bình 1.700m, độ sâu 7 – 10m, lưu lượng dao động từ 1.814 – 19.540m3/s.</p>
            <p>- Sông Hậu là nhánh lớn thứ hai của sông Mêkông chảy qua địa phận Việt Nam với chiều dài khoảng 75km, lưu
                lượng bình quân dao động từ 1.154 – 12.434m3/s.</p>
            <p>- Sông Măng Thít nối sông Tiền và sông Hậu, cửa sông ở phía sông Tiền lớn hơn phía sông Hậu. Do tác động
                của triều cường từ sông Cổ Chiên và sông Hậu, sông Mang Thít chảy theo hai chiều nước vào và ra ở hai
                cửa sông, cụ thể khi triều cường lên nước chảy vào từ hai cửa sông Quới An và Trà Ôn; khi triều cường
                xuống nước sông chảy ra từ 2 cửa trên, vùng giáp nước 2 chiều là cửa Ba Kè (ngã ba Thầy Hạnh) cách sông
                Hậu 17km. Sông Măng Thít không bị ảnh hưởng mặn nên có nước ngọt quanh năm, thuận lợi cho quá trình sản
                xuất nông nghiệp, công nghiệp và sinh hoạt của nhân dân địa phương. Tuy nhiên do cao trình đất ở vùng
                phía Bắc sông Măng Thít thấp trũng nên vấn đề thoát nước sẽ khó hơn.</p>
            <p>&nbsp;Mực nước và biên độ triều trên các sông khá cao, cường độ triều truyền mạnh, vào mùa lũ biên độ
                triều khoảng 70 - 90 cm và vào mùa khô, biên độ triều dao động 114 – 140cm, kết hợp với hệ thống kênh
                mương nội đồng nên có khả năng tưới tiêu tự chảy tốt, giúp cho cây trồng sinh trưởng và phát triển.</p>
            <p>Thời tiết, khí hậu khá thuận lợi cho nông nghiệp theo hướng đa canh, thâm canh tăng vụ và thích hợp cho
                đa dạng sinh học tự nhiên phát triển. Tuy nhiên, do lượng mưa chỉ tập trung vào 6 tháng mùa mưa cùng với
                nguồn nước lũ từ khu vực thượng nguồn của sông MêKông tạo nên những khu vực bị ngập úng cục bộ, ảnh
                hưởng đối với sản xuất nông nghiệp, ảnh hưởng đến đời sống sinh hoạt của người dân và môi trường sinh
                thái khu vực.</p>

        </div>
    </div>
    @include('/components.footer')
</body>

</html>
