-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 04 May 2020, 23:41:11
-- Sunucu sürümü: 10.3.22-MariaDB
-- PHP Sürümü: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `softwar6_demo`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayar`
--

CREATE TABLE `ayar` (
  `ayar_id` int(11) NOT NULL,
  `ayar_logo` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_url` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_title` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_description` varchar(250) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_keywords` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_tel` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `ayar_gsm` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayar`
--

INSERT INTO `ayar` (`ayar_id`, `ayar_logo`, `ayar_url`, `ayar_title`, `ayar_description`, `ayar_keywords`, `ayar_tel`, `ayar_gsm`) VALUES
(0, 'images/26042Başlıksız-1.png', 'http://softwaredemo.tr.ht/', 'Başlıksız', 'Başlıksız', 'key', '0850 840 80 76', '0850 840 80 76');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim`
--

CREATE TABLE `iletisim` (
  `iletisim_id` int(11) NOT NULL,
  `iletisim_isim` text NOT NULL,
  `iletisim_mail` text NOT NULL,
  `iletisim_mesaj` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `iletisim`
--

INSERT INTO `iletisim` (`iletisim_id`, `iletisim_isim`, `iletisim_mail`, `iletisim_mesaj`) VALUES
(1, 'asdf', 'deneme@gmail.com', 'sdafdf');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kredionay`
--

CREATE TABLE `kredionay` (
  `kredi_id` int(11) NOT NULL,
  `kredi_tarih` text NOT NULL,
  `k_isteyen` text NOT NULL,
  `kredi_iban` text NOT NULL,
  `kredi_miktar` text NOT NULL,
  `kredi_durum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `k_id` int(11) NOT NULL,
  `k_isim` varchar(50) NOT NULL,
  `k_mail` varchar(150) NOT NULL,
  `k_kadi` varchar(50) NOT NULL,
  `k_sifre` varchar(50) NOT NULL,
  `k_bakiye` float(9,2) NOT NULL,
  `admin_durum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`k_id`, `k_isim`, `k_mail`, `k_kadi`, `k_sifre`, `k_bakiye`, `admin_durum`) VALUES
(1, 'Ramazan', 'ramazankaraca5@gmail.com', 'rkrc', '5d503795d97c94688670d82accd8c35e', 10.00, 1),
(2, 'LeftSoft', 'ramazankaraca@gmail.com', 'ramazan', '5d503795d97c94688670d82accd8c35e', 1010.00, 0),
(3, 'Deneme', 'dadsa@gmail.com', 'ramazank', '5d503795d97c94688670d82accd8c35e', 0.00, 0),
(4, 'Selim', 'Selimakarsu2534@gmail.com', 'Selim25', 'c4a1d42aad8a00bcc27e38ae20f35293', 5000.00, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `sendid` int(11) NOT NULL,
  `updateTime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `messages`
--

INSERT INTO `messages` (`id`, `userid`, `sendid`, `updateTime`) VALUES
(1, 1, 2, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `messages_sub`
--

CREATE TABLE `messages_sub` (
  `id` int(11) NOT NULL,
  `messagesid` int(11) NOT NULL,
  `text` text COLLATE utf8_turkish_ci NOT NULL,
  `date` text COLLATE utf8_turkish_ci NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `messages_sub`
--

INSERT INTO `messages_sub` (`id`, `messagesid`, `text`, `date`, `userid`) VALUES
(1, 1, 'deneme', '04.05.2020 23:40', 2),
(2, 0, 'sdfsdafsdaf', '04.05.2020 23:40', 2),
(3, 0, 'sfasdfds', '04.05.2020 23:40', 2);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `satis`
--

CREATE TABLE `satis` (
  `satis_id` int(11) NOT NULL,
  `k_id` int(11) NOT NULL,
  `k_satan` text NOT NULL,
  `k_satinalan` text NOT NULL,
  `k_satinalani` text NOT NULL,
  `k_tarih` text NOT NULL,
  `satis_baslik` varchar(150) NOT NULL,
  `satis_resim` text NOT NULL,
  `satis_aciklama` text NOT NULL,
  `satis_kategori` varchar(25) NOT NULL,
  `satis_fiyat` float(9,2) NOT NULL,
  `satis_tarih` text NOT NULL,
  `satis_onay` int(11) NOT NULL,
  `satis_durum` int(11) NOT NULL,
  `kredi_onay` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `satis`
--

INSERT INTO `satis` (`satis_id`, `k_id`, `k_satan`, `k_satinalan`, `k_satinalani`, `k_tarih`, `satis_baslik`, `satis_resim`, `satis_aciklama`, `satis_kategori`, `satis_fiyat`, `satis_tarih`, `satis_onay`, `satis_durum`, `kredi_onay`) VALUES
(1, 1, 'Ramazan', '', '', '', 'deneme hesap', 'images/itprv.jpg', 'asd', 'İnstagram', 100.00, '10/10/2020', 1, 1, 0),
(2, 1, 'Ramazan', '2', 'LeftSoft', '04.05.2020', 'Tiktok 15M İzlenmeli Hesap', 'images/tiktok.jpg', 'asfasdf', 'tiktok', 10.00, '04.05.2020', 0, 1, 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ayar`
--
ALTER TABLE `ayar`
  ADD PRIMARY KEY (`ayar_id`);

--
-- Tablo için indeksler `iletisim`
--
ALTER TABLE `iletisim`
  ADD PRIMARY KEY (`iletisim_id`);

--
-- Tablo için indeksler `kredionay`
--
ALTER TABLE `kredionay`
  ADD PRIMARY KEY (`kredi_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`k_id`);

--
-- Tablo için indeksler `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `messages_sub`
--
ALTER TABLE `messages_sub`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `satis`
--
ALTER TABLE `satis`
  ADD PRIMARY KEY (`satis_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `iletisim`
--
ALTER TABLE `iletisim`
  MODIFY `iletisim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `kredionay`
--
ALTER TABLE `kredionay`
  MODIFY `kredi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `messages_sub`
--
ALTER TABLE `messages_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `satis`
--
ALTER TABLE `satis`
  MODIFY `satis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
