-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 22, 2021 lúc 04:06 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `database_thucung2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `information_post`
--

CREATE TABLE `information_post` (
  `id` int(11) NOT NULL COMMENT 'id bài post',
  `type_post` int(11) DEFAULT NULL COMMENT 'tin đăng',
  `title` varchar(100) NOT NULL,
  `slug_product` varchar(150) DEFAULT NULL,
  `id_menu` int(11) NOT NULL,
  `id_category` int(11) DEFAULT NULL,
  `age` varchar(150) DEFAULT NULL COMMENT 'giới tính',
  `status` varchar(150) DEFAULT NULL COMMENT 'tình trạng sức khỏe',
  `render` varchar(150) DEFAULT NULL COMMENT 'tuổi',
  `price` int(11) NOT NULL COMMENT 'giá',
  `discount` int(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` varchar(250) NOT NULL COMMENT 'mô tả',
  `time` int(11) DEFAULT NULL COMMENT 'thời gian đăng bài',
  `image` text NOT NULL COMMENT 'hình thú',
  `brand` varchar(150) DEFAULT NULL,
  `view` int(11) DEFAULT 0 COMMENT 'lượt xem',
  `id_product` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `information_post`
--

INSERT INTO `information_post` (`id`, `type_post`, `title`, `slug_product`, `id_menu`, `id_category`, `age`, `status`, `render`, `price`, `discount`, `quantity`, `description`, `time`, `image`, `brand`, `view`, `id_product`, `id_status`) VALUES
(1, 2, 'bán chó pug', 'ban-cho-pug-1634574122', 1, 1, '11 tháng', 'khỏe mạnh', 'giống đực', 1100000, 1000000, 0, 'sản phẩm uy tín chất lượng cao', 2, '[\"1634657801-thucung.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, 123, 0, 1),
(2, 2, 'bán chó poodle đẹp nhất', 'ban-cho-poodle-dep-nhat-1634574071', 1, 1, '12 tháng', 'khỏe mạnh', 'giống đực', 1200000, NULL, 0, 'sản phẩm uy tín chất lượng cao....', 2, '[\"1634657801-thucung.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, 123, 0, 1),
(3, 1, 'bán sản phẩm thực phẩm chức năng cho chó', 'ban-san-pham-thuc-pham-chuc-nang-cho-cho-1636529372', 3, 13, 'made in việt nam', 'còn hạn sử dụng', NULL, 100000, 90000, 50, 'đây là sản phẩm chất lượng tốt', 2, '[\"1634657801-thucung.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', 'made in việt nam', 123, 0, 1),
(4, 2, 'bán thú cưng husky nặng 17kg', 'ban-thu-cung-husky-nang-17kg-1634657801', 1, 3, '12 tháng', 'khỏe mạnh', 'cái', 120000, 100000, NULL, '<p>đây là chó husky ok&nbsp;</p>', NULL, '[\"1634657801-thucung.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, NULL, 0, 1),
(7, 1, '123123sd', '123123sd-1636732587', 6, 13, NULL, NULL, NULL, 12391238, 100000, 12, '<p>sadadsa</p>', NULL, '[\"meo.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, NULL, NULL, 1),
(8, 1, '12312312', '12312312-1638702814', 3, 15, NULL, NULL, NULL, 12391238, 100000, 100, '<p>dsfdfsdfdsfsdf</p>', NULL, '[\"meo.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, 0, NULL, 1),
(9, 1, 'có cái nịt', 'co-cai-nit-1638702970', 1, 2, NULL, NULL, NULL, 120000, 100000, 12, '<p>sadasdsad</p>', NULL, 'dichvu.jpg', NULL, 0, NULL, 1),
(10, 1, '123123123', '123123123-1638703548', 1, 3, NULL, NULL, NULL, 123123, 123123, 12, '<p>1231231</p>', NULL, '[\"meo.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, 0, NULL, 1),
(11, 1, '123123123', '123123123-1638703564', 1, 5, NULL, NULL, NULL, 123123, 123123, 12, '<p>sadasdasd</p>', NULL, '[\"1634657801-thucung.jpg\",\"dog.jpg\",\"dichvu.jpg\"]', NULL, 0, NULL, 1),
(12, 1, '123123', '123123-1639347747', 1, 9, NULL, NULL, NULL, 120000, 100000, 12, '<p>ádsadsadsad</p>', NULL, '1634657801-thucung.jpg', NULL, 0, NULL, 1),
(13, 1, '123123', '123123-1639070671', 1, 2, NULL, NULL, NULL, 120000, 100000, 12, '<p>ádasd</p>', NULL, 'dichvu.jpg', NULL, 0, NULL, 2),
(14, 1, 'lồng nhốt thú cưng dễ thương', 'long-nhot-thu-cung-de-thuong-1639896253', 7, NULL, NULL, NULL, NULL, 1299000, 1990000, 1000, '<p>ádasdad</p>', NULL, '[\"1634895662-thucung.jpg\",\"1634895466-thucung.jpg\",\"1634895382-thucung.jpg\",\"1634895298-thucung.jpg\"]', NULL, 0, NULL, 1),
(15, 1, 'CHARCOAL PLUS', 'charcoal-plus-1639911698', 1, 1, NULL, NULL, NULL, 28000, 23000, 10, '<p>Sản phẩm chất lượng cao</p>', NULL, 'sp1.jpg', 'CHARCOAL PLUS', 0, NULL, 1),
(16, 1, 'SẢN PHẨM ĐẶC BIỆT CHĂM SÓC THÚ CƯNG, ĐẶC TRỊ CHÓ MÈO', 'san-pham-dac-biet-cham-soc-thu-cung-dac-tri-cho-meo-1639911784', 1, 2, NULL, NULL, NULL, 50000, 45000, 30, '<p>Sản phẩm chất lượng cao</p>', NULL, 'sp2.jpg', 'BỘ SẢN PHẨM CHÓ MÈO', 0, NULL, 1),
(17, 1, 'ĐẶC TRỊ BỆNH TRUYỀN NHIỄM DO VI KHUẨN TRÊN CHÓ, MÈO', 'dac-tri-benh-truyen-nhiem-do-vi-khuan-tren-cho-meo-1639911870', 1, 8, NULL, NULL, NULL, 80000, 60000, 5, '<p>Sản phẩm cao cấp</p>', NULL, 'sp3.jpg', 'KHÁNG SINH CHÓ MÈO CAO CẤP', 0, NULL, 1),
(18, 1, 'ĐẶC TRỊ TIÊU CHẢY, LEPTO, KIẾT LỴ, VIÊM PHỔI, BỆNH GHÉP NHIỄM KHUẨN NẶNG TRÊN CHÓ MÈO', 'dac-tri-tieu-chay-lepto-kiet-ly-viem-phoi-benh-ghep-nhiem-khuan-nang-tren-cho-meo-1639911954', 1, 6, NULL, NULL, NULL, 100000, 94000, 11, '<p>sản phẩm ổn</p>', NULL, 'sp4.jpg', 'GENTOCINE PLUS', 0, NULL, 1),
(19, 1, 'KHÁNG SINH ĐẶC TRỊ BỆNH CHÓ MÈO', 'khang-sinh-dac-tri-benh-cho-meo-1639912007', 1, 6, NULL, NULL, NULL, 27000, 25000, 98, '<p>Tốt</p>', NULL, 'sp5.jpg', 'CẶP KHÁNG SINH CHÓ MÈO CAO CẤP', 0, NULL, 1),
(20, 1, 'KHÁNG SINH TỔNG HỢP PHỔ RỘNG, ĐẶC TRỊ BỆNH CHÓ MÈO', 'khang-sinh-tong-hop-pho-rong-dac-tri-benh-cho-meo-1639912125', 1, 5, NULL, NULL, NULL, 150000, 140000, 50, '<p>Tốt</p>', NULL, 'sp6.jpg', 'TD-DOGENTA', 0, NULL, 1),
(21, 1, 'ĐẶC TRỊ KÝ SINH TRÙNG, GIUN ĐŨA, GIUN KIM, GIUN TÓC, GIUN PHỔI', 'dac-tri-ky-sinh-trung-giun-dua-giun-kim-giun-toc-giun-phoi-1639912512', 1, 3, NULL, NULL, NULL, 100000, 99000, 80, '<p>Tốt</p>', NULL, 'sp7.jpg', 'TD. LEVA', 0, NULL, 1),
(22, 1, 'CUNG CẤP VITAMIN NÂNG CAO SỨC ĐỀ KHÁNG CHỐNG ĐỘC, CHỐNG STRESS, CHỐNG CÒI CỌC', 'cung-cap-vitamin-nang-cao-suc-de-khang-chong-doc-chong-stress-chong-coi-coc-1639912614', 1, 4, NULL, NULL, NULL, 150000, 145000, 15, '<p>Tốt</p>', NULL, 'sp8.jpg', 'TD. POLIVIT', 0, NULL, 1),
(23, 1, 'SỮA TẮM CAO CẤP CHÓ, MÈO', 'sua-tam-cao-cap-cho-meo-1639912716', 1, NULL, NULL, NULL, NULL, 200000, 180000, 12, '<p>Tốt</p>', NULL, 'sp9.jpg', 'DEAR DOKET', 0, NULL, 1),
(24, 1, 'GEL DINH DƯỠNG CAO CẤP CHO CHÓ MÈO', 'gel-dinh-duong-cao-cap-cho-cho-meo-1639912797', 1, 3, NULL, NULL, NULL, 50000, 45000, 15, '<p>Tốt</p>', NULL, 'sp10.jpg', 'TD.NUTROGEL', 0, NULL, 1),
(25, 1, 'Tăng lực, sung mãn, dẻo dai, tăng cường đề kháng', 'tang-luc-sung-man-deo-dai-tang-cuong-de-khang-1639912875', 1, 5, NULL, NULL, NULL, 100000, 90000, 130, '<p>Tốt</p>', NULL, 'sp11.jpg', 'AMINOGINSEN CS', 0, NULL, 1),
(26, 1, 'Men tiêu hóa sống tăng cường lợi khuẩn', 'men-tieu-hoa-song-tang-cuong-loi-khuan-1639912973', 1, 3, NULL, NULL, NULL, 80000, 78000, 59, '<p>Tốt</p>', NULL, 'sp12.jpg', 'BACILLUS ENZYM CS', 0, NULL, 1),
(27, 1, 'Kháng sinh tổng hợp phổ rộng đặc trị bệnh hô hấp, tiêu hóa', 'khang-sinh-tong-hop-pho-rong-dac-tri-benh-ho-hap-tieu-hoa-1639913046', 1, 8, NULL, NULL, NULL, 290000, 250000, 59, '<p>Tốt</p>', NULL, 'sp13.jpg', 'Td.Dogenta CS', 0, NULL, 1),
(28, 1, 'ĐẶC TRỊ NỘI – NGOẠI KÝ SINH TRÙNG', 'dac-tri-noi-ngoai-ky-sinh-trung-1639913105', 1, 12, NULL, NULL, NULL, 180000, 160000, 39, '<p>Tốt</p>', NULL, 'sp14.jpg', 'TD.BUTOMEC', 0, NULL, 1),
(29, 2, 'Mèo tindi', 'meo-tindi-1640076363', 3, 14, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Cái', 18000000, 17000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Mèo ragdoll bố mẹ nhập có phả có thể làm phả giới tính cái 9 tháng</span><br></p>', NULL, 'thucung1.jpeg', NULL, 0, NULL, 1),
(30, 2, 'Chó Poodle 1 tuổi rưỡi', 'cho-poodle-1-tuoi-ruoi-1640076604', 1, 2, '1 tuổi rưỡi', 'Tốt', 'Đực', 7000000, 6700000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Có sổ tim ngừa đầy đủ</span><br></p>', NULL, 'tc2.jpg', NULL, 0, NULL, 1),
(31, 2, 'ALN silver shaded (ns11)', 'aln-silver-shaded-ns11-1640076664', 3, 17, 'Dưới 60 ngày', 'Tốt', 'Cái', 11000000, 10000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">bé được 55 ngày tuổi , đã biết đi cát và ăn hạt</span><br></p>', NULL, 'tc3.jpg', NULL, 0, NULL, 1),
(32, 2, 'Mèo ALN', 'meo-aln-1640076749', 3, 17, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 7500000, 7000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Bé mèo nhà nuôi sinh sản, cha mẹ đều là ALN</span><br></p>', NULL, 'tc4.jpg', NULL, 0, NULL, 1),
(33, 2, 'Pug mặt xệ thuần chủng', 'pug-mat-xe-thuan-chung-1640076941', 1, 1, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 3000000, 2800000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Các bé tìm nhà mới\r\nPhàm ăn như lợn gì cũng hết</span><br></p>', NULL, 'tc6.jpg', NULL, 0, NULL, 1),
(34, 2, 'Mèo anh lông ngắn thuần chủng', 'meo-anh-long-ngan-thuan-chung-1640077156', 3, 17, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Cái', 4000000, 3900000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Nhà em có đàn mèo anh lông ngắn( bảo hành thuần chủng 100%)\r\nCác bé hơn 2 tháng tuổi\r\nBiết nựng quấn người cực đáng yêu\r\nBiết đi vệ sinh trong khay cát ạ</span><br></p>', NULL, 'tc7.jpg', NULL, 0, NULL, 1),
(35, 2, 'Mèo anh xám mặt bánh bao', 'meo-anh-xam-mat-banh-bao-1640077330', 3, 17, 'dưới 60ngayf', 'Tốt', 'Cái', 5000000, 4500000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Mặt bánh bao</span><br></p>', NULL, 'tc8.jpg', NULL, 0, NULL, 1),
(36, 2, 'Atika.niu.cho xuat xu nhat ban', 'atikaniucho-xuat-xu-nhat-ban-1640077598', 1, 9, '1-2 tuổi', 'Tốt', 'Cái', 18000000, 17000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Atika.niu.cho xuat xu nhat ban</span><br></p>', NULL, 'tc10.jpg', NULL, 0, NULL, 1),
(37, 2, 'Corgi fluffy male siêu đẹp', 'corgi-fluffy-male-sieu-dep-1640077750', 1, 8, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 25000000, 24300000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">70 ngày tiêm 2 mũi\r\nGiấy vka chính chủ</span><br></p>', NULL, 'tc 11.jpg', NULL, 0, NULL, 1),
(38, 2, 'Chó Golden - Labrador', 'cho-golden-labrador-1640078063', 1, 4, 'dưới 60 ngày', 'Tốt', 'Cái', 6000000, 5500000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Cam kết thuần chủng\r\nBảo hành sức khoẻ</span><br></p>', NULL, '1634574122-phim.jpg', NULL, 0, NULL, 1),
(39, 2, 'Chó Poodle', 'cho-poodle-1640078150', 1, 2, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Cái', 6000000, 4000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Cún nhà đẻ, ăn uống tốt, vệ sinh đúng chỗ, cún đã sổ giun và tiêm phòng\r\nXem cún tại 28/117 trần cung, cầu giấy HN</span><br></p>', NULL, 'tc14.jpg', NULL, 0, NULL, 1),
(40, 2, 'bé alaska tìm chủ yêu thương', 'be-alaska-tim-chu-yeu-thuong-1640078939', 1, 12, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 12000000, 10000000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Tặng kèm 1 mũi microchip định danh cho bé</span><br></p>', NULL, 'tc20.jpg', NULL, 0, NULL, 1),
(41, 2, 'Alaska cái 10 thág sắp solo bán chó và chuồn luôn giá 9tr', 'alaska-cai-10-thag-sap-solo-ban-cho-va-chuon-luon-gia-9tr-1640079344', 1, 8, 'Từ 1 tuổi tới 2 tuổi', 'Tốt', 'Cái', 9000000, 8500000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Cần tìm người nuôi bé sinh sản đang hoàn bé rất ngoan</span><br></p>', NULL, 'tc23.jpg', NULL, 0, NULL, 1),
(42, 2, 'Poodle Lai Nhật Siêu Kute', 'poodle-lai-nhat-sieu-kute-1640079429', 1, 2, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 1500000, 1450000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Chính chủ, ba mẹ yêu thương đón các con về nhà ăn Tết đi ạ.</span><br></p>', NULL, 'tc24.jpg', NULL, 0, NULL, 1),
(43, 2, 'Poodle tiny thuần chủng nhà đẻ', 'poodle-tiny-thuan-chung-nha-de-1640079578', 1, 2, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Đực', 3000000, 2900000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Ưu quận tâm alo em hoặc ib qua Zalo em tư vấn cụ thể</span><br></p>', NULL, 'tc26.jpg', NULL, 0, NULL, 1),
(44, 2, 'Mèo scottish Giới tính cái', 'meo-scottish-gioi-tinh-cai-1640079652', 3, 13, 'Từ 60 ngày tới 1 tuổi', 'Tốt', 'Cái', 4500000, 4400000, 1, '<p><span style=\"color: rgb(87, 63, 30); font-size: 13px; white-space: pre-wrap;\">Mèo scottish giới tính cái</span><br></p>', NULL, 'tc27.jpg', NULL, 0, NULL, 1),
(45, 2, 'Corgi Pembroke', 'corgi-pembroke-1640183855', 1, 8, '4 tháng', 'Tốt', 'Đực', 12000000, 11000000, 1, '<p style=\"margin-bottom: 1.3em; color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Đã tiêm ngừa 3 mũi bệnh + 1 mũi dại</p>', NULL, 'tc28.jpg', NULL, 0, NULL, 1),
(46, 2, 'Pitbull', 'pitbull-1640184051', 1, 6, '2 tháng', 'Tốt', 'Cái', 5000000, 4900000, 1, '<p>Màu vàng kem</p>', NULL, 'tc29.jpg', NULL, 0, NULL, 1),
(47, 2, 'Poodle Xám Khói', 'poodle-xam-khoi-1640184166', 1, 2, '3 tháng', 'Tốt', 'Đực', 8000000, 7600000, 1, '<p><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Giống: Poodle tinyteacup</span><br></p>', NULL, 'tc30.jpg', NULL, 0, NULL, 1),
(48, 2, 'Pug trắng', 'pug-trang-1640184312', 1, 1, '2 tháng', 'Tốt', 'Cái', 5500000, 5000000, 1, '<p>Pug mặt xệ</p>', NULL, 'tc31.jpg', NULL, 0, NULL, 1),
(49, 2, 'chó chowchow trắng kem', 'cho-chowchow-trang-kem-1640184452', 1, 12, '2 tháng', 'Tốt', 'Đực', 15000000, 14700000, 1, '<p style=\"margin-bottom: 1.3em; color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Giống: chó Chowchow. Màu sắc: trắng kem</p>', NULL, 'tc32.jpg', NULL, 0, NULL, 1),
(50, 2, 'chó Chowchow vàng', 'cho-chowchow-vang-1640184557', 1, 12, '2 tháng', 'Tốt', 'Đực', 15000000, 14700000, 1, '<p><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">N</span><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">hân giống tại Trang trại Binhtran pet house</span></p>', NULL, 'tc33.jpg', NULL, 0, NULL, 1),
(51, 2, 'Mèo Anh Lông Ngắn Munchkin', 'meo-anh-long-ngan-munchkin-1640184665', 3, 17, '8 tháng', 'Tốt', 'Đực', 10000000, 9100000, 1, '<p><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Màu sắc: Xám Xanh</span><br></p>', NULL, 'tc34.jpg', NULL, 0, NULL, 1),
(52, 2, 'mèo Bengal', 'meo-bengal-1640184786', 3, 23, '2 tháng', 'Tốt', 'Đực', 15900000, 15500000, 1, '<p>Màu nâu</p>', NULL, 'tc35.jpg', NULL, 0, NULL, 1),
(53, 2, 'mèo munchkin tabby red', 'meo-munchkin-tabby-red-1640185023', 3, 22, '2 tháng', 'Tốt', 'Đực', 10000000, 9000000, 1, '<p><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Màu sắc: tabby red</span><br></p>', NULL, 'tc37.jpg', NULL, 0, NULL, 1),
(54, 2, 'mèo Munchkin chân ngắn', 'meo-munchkin-chan-ngan-1640185101', 3, 22, '2 tháng', 'Tốt', 'Cái', 12000000, 11000000, 1, '<p><span style=\"color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Màu sắc: silver</span><br></p>', NULL, 'tc38.jpg', NULL, 0, NULL, 1),
(55, 2, 'mèo munchkin bicolor', 'meo-munchkin-bicolor-1640185176', 3, 22, '3 tháng', 'Tốt', 'Đực', 12000000, 11000000, 1, '<p style=\"margin-bottom: 1.3em; color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Giống: mèo Munchkin chân ngắn. Màu sắc: bicolor</p>', NULL, 'tc39.jpg', NULL, 0, NULL, 1),
(56, 2, 'mèo Munchkin chân ngắn tuxedo', 'meo-munchkin-chan-ngan-tuxedo-1640185255', 3, 22, '2 tháng', 'Tốt', 'Cái', 15000000, 14700000, 1, '<p style=\"margin-bottom: 1.3em; color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Giống: mèo Munchkin chân ngắn. Màu sắc: tuxedo</p>', NULL, 'tc40.jpg', NULL, 0, NULL, 1),
(57, 2, 'mèo Scottish tai cụp', 'meo-scottish-tai-cup-1640185332', 3, 19, '3 tháng', 'Tốt', 'Đực', 19000000, 15000000, 1, '<p style=\"margin-bottom: 1.3em; color: rgb(123, 123, 123); font-family: Roboto, sans-serif; font-size: 14px;\">Giống: Mèo scottish lông ngắn tai cụp. Màu sắc: trắng kem</p>', NULL, 'tc41.jpg', NULL, 0, NULL, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `information_post`
--
ALTER TABLE `information_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_menu` (`id_menu`,`id_category`),
  ADD KEY `id_category` (`id_category`),
  ADD KEY `id_typepost` (`type_post`),
  ADD KEY `id_trangthai` (`id_status`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `information_post`
--
ALTER TABLE `information_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id bài post', AUTO_INCREMENT=58;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `information_post`
--
ALTER TABLE `information_post`
  ADD CONSTRAINT `information_post_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `information_post_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `nav_menu` (`id`),
  ADD CONSTRAINT `information_post_ibfk_3` FOREIGN KEY (`type_post`) REFERENCES `type_post` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
