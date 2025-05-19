-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2025 a las 07:55:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendaderopadeportiva`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Nutrición'),
(2, 'Ropa deportiva'),
(3, 'Calzado deportivo'),
(4, 'Equipo deportivo'),
(5, 'Accesorios Exclusivos'),
(6, 'Ultimos productos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deportes`
--

CREATE TABLE `deportes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `deportes`
--

INSERT INTO `deportes` (`id`, `nombre`) VALUES
(1, 'Fútbol'),
(2, 'Baloncesto'),
(3, 'Running'),
(4, 'Tenis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `nombre_producto` varchar(255) NOT NULL,
  `imagen_producto` varchar(255) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle`, `id_compra`, `cantidad`, `nombre_producto`, `imagen_producto`, `precio_unitario`, `id_producto`) VALUES
(8, 4, 1, 'Jacket Nike', 'https://www.nike.com.pe/dw/image/v2/BJKZ_PRD/on/demandware.static/-/Sites-catalog-equinox/default/dw1269a1ab/images/hi-res/196607612545_1_20230822120000-mrtPeru.jpeg?sw=500&sh=500', 120.00, 5),
(9, 4, 1, 'Camisa blanca Nike', 'https://www.nike.com.pe/dw/image/v2/BJKZ_PRD/on/demandware.static/-/Sites-catalog-equinox/default/dwdc242b30/images/hi-res/196607611401_1_20230905120000-mrtPeru.jpeg?sw=800&sh=800', 120.00, 6),
(10, 5, 1, 'Camisa Verde Nike', 'https://images.nike.com/is/image/DotCom/DX3340_386_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 199.00, 4),
(11, 5, 1, 'Impact Whey Isolate', 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Impact-Whey-Isolate-2-450x450.png', 249.00, 28),
(12, 5, 1, 'Mutant Mass', 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Mutant-Mass-450x450.png', 179.00, 29),
(13, 5, 1, 'Impact Whey Protein', 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Impact-Whey-Protein-2-450x450.png', 189.00, 32),
(14, 5, 1, 'Vegan Protein', 'https://smartnutrition.com.pe/wp-content/uploads/2023/07/1000085469-450x450.jpg', 319.00, 31),
(15, 6, 1, 'Nike Air Force 1 107', 'https://images.nike.com/is/image/DotCom/CW2288_111_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 529.90, 14),
(16, 6, 1, 'Nike Court Royale', 'https://images.nike.com/is/image/DotCom/749747_010_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 134.95, 23),
(17, 6, 1, 'Nike Dunk Low Retro', 'https://images.nike.com/is/image/DotCom/DD1391_100_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 539.90, 24),
(18, 6, 1, 'Liverpool FC AWF', 'https://images.nike.com/is/image/DotCom/DV1919_012_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 279.00, 36),
(19, 7, 1, 'Nike Dri-FlT ', 'https://images.nike.com/is/image/DotCom/CZ9184_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 189.90, 37),
(20, 7, 1, 'Retro Track Jacket', 'https://cdn.shopify.com/s/files/1/1367/5207/files/RetroTrackJacket-GSCamoBrown-GSLinenBrown-GSWashedStoneBrownA4A9V-NB8R-1667_384x.jpg?v=1696606389', 95.00, 89),
(21, 7, 1, 'Vibes Gilet', 'https://cdn.shopify.com/s/files/1/1367/5207/products/VibesGiletBlackA3A5W-BBBB-1059.105_e3abe5b8-0e17-40e6-8579-cb634c0a3be7_384x.jpg?v=1679304926', 48.00, 91),
(22, 7, 1, 'Apex Jacket', 'https://cdn.shopify.com/s/files/1/1367/5207/files/ApexJacket-LightGrey-A3A7X-GBCM-1008_b10e8d3b-a6b9-487b-a677-cb6240b9e328_384x.jpg?v=1692885051', 110.00, 90),
(23, 8, 1, 'Nike Dri-FlT ', 'https://images.nike.com/is/image/DotCom/CZ9184_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 189.90, 37),
(24, 8, 1, 'Retro Track Jacket', 'https://cdn.shopify.com/s/files/1/1367/5207/files/RetroTrackJacket-GSCamoBrown-GSLinenBrown-GSWashedStoneBrownA4A9V-NB8R-1667_384x.jpg?v=1696606389', 95.00, 89),
(25, 8, 1, 'Vibes Gilet', 'https://cdn.shopify.com/s/files/1/1367/5207/products/VibesGiletBlackA3A5W-BBBB-1059.105_e3abe5b8-0e17-40e6-8579-cb634c0a3be7_384x.jpg?v=1679304926', 48.00, 91),
(26, 8, 1, 'Apex Jacket', 'https://cdn.shopify.com/s/files/1/1367/5207/files/ApexJacket-LightGrey-A3A7X-GBCM-1008_b10e8d3b-a6b9-487b-a677-cb6240b9e328_384x.jpg?v=1692885051', 110.00, 90),
(27, 8, 1, 'Nike anillos', 'https://i.pinimg.com/1200x/34/db/e4/34dbe4b0268d2bfffe5eb413235fc3ba.jpg', 350.00, 69),
(28, 8, 1, 'NIKE Gold Necklace', 'https://i.pinimg.com/1200x/ea/50/43/ea50434e49e3d28f0e8903819db5fcf8.jpg', 400.00, 70),
(29, 8, 1, 'Pendientes Mini Swoos', 'https://sneakeradds.com/wp-content/uploads/2022/08/Sneakeradds_4-02-min-1.jpg', 30.00, 71),
(30, 8, 1, 'adidas necklace', 'https://i.pinimg.com/originals/51/50/22/515022059e47a0905884acc39c191e79.jpg', 300.00, 72),
(31, 8, 1, 'Pulsera Espiga Puma', 'https://viancca.com.pe/wp-content/uploads/2021/12/IMG_20211213_161107-scaled.jpg', 50.00, 79),
(32, 8, 1, 'Anillo de puma', 'https://digitaljewelry.com/wp-content/uploads/2015/02/seneca2.jpg', 109.00, 78),
(33, 8, 1, 'adidas Reloj', 'https://m.media-amazon.com/images/I/61rumuAng1L._AC_UY1000_.jpg', 150.00, 74),
(34, 8, 1, 'Adidas Pendientes', 'https://img.mytheresa.com/1094/1236/90/jpeg/catalog/product/1e/P00762342_d3.jpg', 30.00, 73),
(35, 8, 1, 'Pulsera Puma', 'https://acdn.mitiendanube.com/stores/804/588/products/picsart_07-08-07-45-271-10887b6bcc226f316c15312397866981-640-0.jpg', 78.00, 80),
(36, 9, 1, 'NikeCourt Air Zoom ', 'https://images.nike.com/is/image/DotCom/DV3258_101_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 339.90, 13),
(37, 9, 1, 'Nike Air Force 1 107', 'https://images.nike.com/is/image/DotCom/CW2288_111_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 529.90, 14),
(38, 9, 1, 'Liverpool FC AWF', 'https://images.nike.com/is/image/DotCom/DV1919_012_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 279.00, 36),
(39, 9, 1, 'Nike Dri-FlT ', 'https://images.nike.com/is/image/DotCom/CZ9184_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 189.90, 37),
(40, 10, 1, 'NikeCourt Air Zoom ', 'https://images.nike.com/is/image/DotCom/DV3258_101_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 339.90, 13),
(41, 10, 1, 'Nike Air Force 1 107', 'https://images.nike.com/is/image/DotCom/CW2288_111_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 529.90, 14),
(42, 10, 1, 'Liverpool FC AWF', 'https://images.nike.com/is/image/DotCom/DV1919_012_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 279.00, 36),
(43, 10, 1, 'Nike Dri-FlT ', 'https://images.nike.com/is/image/DotCom/CZ9184_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 189.90, 37),
(44, 10, 3, 'Nike Pitch Training', 'https://images.nike.com/is/image/DotCom/CU8034_720_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 71.92, 45),
(45, 10, 3, 'Nike Academy', 'https://images.nike.com/is/image/DotCom/CU8047_102_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 109.90, 46),
(46, 10, 2, 'Nike Sportswear', 'https://images.nike.com/is/image/DotCom/CW9300_010_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500', 119.90, 47),
(47, 10, 3, 'Maleta Deportiva', 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/c97a4b58a2cc43309cd2af4e009b1e68_9366/Maleta_Deportiva_Grande_Tiro_League_Rojo_IB8656_01_standard.jpg', 219.00, 48),
(48, 10, 1, 'Botella mezcladora', 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_350,h_350/global/053519/01/fnd/EEA/fmt/png/Botella-mezcladora-PUMA', 17.00, 63);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_compras`
--

CREATE TABLE `historial_compras` (
  `id_compra` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `total_pagado` decimal(10,2) NOT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `historial_compras`
--

INSERT INTO `historial_compras` (`id_compra`, `order_id`, `total_pagado`, `fecha_compra`, `usuario_id`) VALUES
(4, '3FC81873AL8918708', 240.00, '2025-05-16 19:36:31', 25),
(5, '6E384270AH012223J', 1334.99, '2025-05-17 05:48:51', 26),
(6, '6KD23971PK2004630', 1483.75, '2025-05-17 05:49:42', 26),
(7, '4AM66933ES7507321', 442.90, '2025-05-17 05:50:17', 26),
(8, '7V975270UF792421S', 1939.90, '2025-05-17 05:51:37', 25),
(9, '1NA93202VJ436240K', 1338.70, '2025-05-17 05:52:08', 25),
(10, '78209730NB794524U', 2797.96, '2025-05-17 05:53:09', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id`, `nombre`) VALUES
(1, 'Adidas'),
(2, 'Puma'),
(3, 'Nike'),
(4, 'Gymshark');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `id_deporte` int(11) DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `activo` int(11) DEFAULT 1,
  `imgRuta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `id_categoria`, `id_deporte`, `id_marca`, `activo`, `imgRuta`) VALUES
(4, 'Camisa Verde Nike', '', 199.00, 6, 1, 1, 1, 'https://images.nike.com/is/image/DotCom/DX3340_386_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(5, 'Jacket Nike', NULL, 120.00, 6, NULL, NULL, 1, 'https://www.nike.com.pe/dw/image/v2/BJKZ_PRD/on/demandware.static/-/Sites-catalog-equinox/default/dw1269a1ab/images/hi-res/196607612545_1_20230822120000-mrtPeru.jpeg?sw=500&sh=500'),
(6, 'Camisa blanca Nike', NULL, 120.00, 6, NULL, NULL, 1, 'https://www.nike.com.pe/dw/image/v2/BJKZ_PRD/on/demandware.static/-/Sites-catalog-equinox/default/dwdc242b30/images/hi-res/196607611401_1_20230905120000-mrtPeru.jpeg?sw=800&sh=800'),
(7, 'T-shirt Nike', NULL, 120.00, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/AR5252_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(8, 'Pants Nike', NULL, 120.00, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/DQ5043_206_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(9, 'Short Nike', NULL, 120.00, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/CU4503_063_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(10, 'Polo plomo Nike', NULL, 199.99, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/AR4997_064_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(11, 'Polo Celeste Nike\r\n', NULL, 199.99, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/AR4997_493_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(12, 'Polo Rosa Nike', NULL, 199.99, 6, NULL, NULL, 1, 'https://images.nike.com/is/image/DotCom/AR4997_686_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(13, 'NikeCourt Air Zoom ', NULL, 339.90, 3, 3, 3, 1, 'https://images.nike.com/is/image/DotCom/DV3258_101_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(14, 'Nike Air Force 1 107', NULL, 529.90, 3, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/CW2288_111_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(23, 'Nike Court Royale', NULL, 134.95, 3, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/749747_010_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(24, 'Nike Dunk Low Retro', NULL, 539.90, 3, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/DD1391_100_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(25, '\'Nike Alphafly 2       \'', NULL, 1299.90, 3, 3, 3, 1, 'https://images.nike.com/is/image/DotCom/DN3555_100_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(26, 'Nike Gripknit ', NULL, 1199.90, 3, 1, 3, 1, 'https://images.nike.com/is/image/DotCom/DC9969_600_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(27, 'Gold Standard', NULL, 379.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Gold-Standard-Whey-450x450.png'),
(28, 'Impact Whey Isolate', NULL, 249.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Impact-Whey-Isolate-2-450x450.png'),
(29, 'Mutant Mass', NULL, 179.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Mutant-Mass-450x450.png'),
(30, 'Anabolic Prime Pro', NULL, 299.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Anabolic-Prime-Pro-450x450.png'),
(31, 'Vegan Protein', NULL, 319.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2023/07/1000085469-450x450.jpg'),
(32, 'Impact Whey Protein', NULL, 189.00, 1, NULL, NULL, 1, 'https://smartnutrition.com.pe/wp-content/uploads/2022/08/Impact-Whey-Protein-2-450x450.png'),
(33, 'Magicrnag ', NULL, 209.00, 1, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/4626588-800-800/image-b84bd3613f9f493e8edfb257217ee457.jpg?v=637657907644070000'),
(34, 'Batido Hnd Sabor', NULL, 94.00, 1, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/6229456-800-800/image-d191ae0870014c34b5342ff49ad014b0.jpg?v=637745079888900000'),
(35, 'Double Strength', NULL, 219.00, 1, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/16321625-800-800/image-212b7aa881d549138b39e45df1d8bfc8.jpg?v=638313089023000000'),
(36, 'Liverpool FC AWF', NULL, 279.00, 2, 1, 3, 1, 'https://images.nike.com/is/image/DotCom/DV1919_012_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(37, 'Nike Dri-FlT ', '', 189.90, 2, 3, 3, 1, 'https://images.nike.com/is/image/DotCom/CZ9184_013_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(38, 'Jordan Jumpman', NULL, 97.00, 2, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/CJ0921_100_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(42, 'Nike Pro Dri-FlT', NULL, 129.90, 2, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/DD1990_068_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(43, 'FC Barcelona ', NULL, 129.90, 2, 1, 3, 1, 'https://images.nike.com/is/image/DotCom/FJ1779_620_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(44, 'Camiseta Alianza Lima', NULL, 134.95, 2, 1, 3, 1, 'https://www.nike.com.pe/dw/image/v2/BJKZ_PRD/on/demandware.static/-/Sites-catalog-equinox/default/dw8ff19307/images/hi-res/196150118198_1_20230111120000-mrtPeru.jpg?sw=500&sh=500'),
(45, 'Nike Pitch Training', NULL, 71.92, 4, 1, 3, 1, 'https://images.nike.com/is/image/DotCom/CU8034_720_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(46, 'Nike Academy', NULL, 109.90, 4, 1, 3, 1, 'https://images.nike.com/is/image/DotCom/CU8047_102_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(47, 'Nike Sportswear', NULL, 119.90, 4, NULL, 3, 1, 'https://images.nike.com/is/image/DotCom/CW9300_010_A?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(48, 'Maleta Deportiva', NULL, 219.00, 4, 1, 1, 1, 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/c97a4b58a2cc43309cd2af4e009b1e68_9366/Maleta_Deportiva_Grande_Tiro_League_Rojo_IB8656_01_standard.jpg'),
(49, 'Bolso Pequeño ', NULL, 49.00, 4, NULL, 1, 1, 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/1a3d56b2d4b04016856caf3a00ddcb36_9366/Bolso_Pequeno_Essentials_para_Audifonos_Negro_HR9800_04_standard.jpg'),
(50, 'Maleta Deportiva', NULL, NULL, 4, NULL, 1, 1, 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/a6f39c217a6446458bfbad9a007bf6d2_9366/Maleta_Deportiva_4ATHLTS_Mediana_Negro_HC7272_01_standard.jpg'),
(60, '2.2L BOTTLE', NULL, 16.00, 4, NULL, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/products/2.2LitreWaterBottle-Black-GABO5412-BK-OSB_e9b95b0a-f817-43c6-bfcc-c26f9900b9cc_1200x.jpg?v=1661856350'),
(61, 'CREW SOCKS 5PK', NULL, 25.00, 4, NULL, 4, 1, 'https://th.bing.com/th/id/OIP.87vOKEXitWqnxuaA1U1qXQHaI1?r=0&cb=iwp2&rs=1&pid=ImgDetMain'),
(62, 'LIFTING GLOVES', NULL, 35.00, 4, NULL, 4, 1, 'https://m.media-amazon.com/images/I/71xIEPhEHrL._AC_SL1500_.jpg'),
(63, 'Botella mezcladora', NULL, 17.00, 4, NULL, 2, 1, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_350,h_350/global/053519/01/fnd/EEA/fmt/png/Botella-mezcladora-PUMA'),
(64, 'Balón de fútbol', NULL, 32.00, 4, NULL, 2, 1, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_350,h_350/global/084108/01/fnd/EEA/fmt/png/Bal%C3%B3n-de-f%C3%BAtbol-de-training-OrbitaLaLigaHybrid'),
(65, 'Mochila Buzz', NULL, 33.00, 4, NULL, 2, 1, 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_350,h_350/global/079136/40/fnd/EEA/fmt/png/Mochila-Buzz'),
(69, 'Nike anillos', NULL, 350.00, 5, NULL, 3, 1, 'https://i.pinimg.com/1200x/34/db/e4/34dbe4b0268d2bfffe5eb413235fc3ba.jpg'),
(70, 'NIKE Gold Necklace', NULL, 400.00, 5, NULL, 3, 1, 'https://i.pinimg.com/1200x/ea/50/43/ea50434e49e3d28f0e8903819db5fcf8.jpg'),
(71, 'Pendientes Mini Swoos', NULL, 30.00, 5, NULL, 3, 1, 'https://sneakeradds.com/wp-content/uploads/2022/08/Sneakeradds_4-02-min-1.jpg'),
(72, 'adidas necklace', NULL, 300.00, 5, NULL, 3, 1, 'https://i.pinimg.com/originals/51/50/22/515022059e47a0905884acc39c191e79.jpg'),
(73, 'Adidas Pendientes', NULL, 30.00, 5, NULL, 1, 1, 'https://img.mytheresa.com/1094/1236/90/jpeg/catalog/product/1e/P00762342_d3.jpg'),
(74, 'adidas Reloj', NULL, 150.00, 5, NULL, 1, 1, 'https://m.media-amazon.com/images/I/61rumuAng1L._AC_UY1000_.jpg'),
(78, 'Anillo de puma', NULL, 109.00, 5, NULL, 2, 1, 'https://digitaljewelry.com/wp-content/uploads/2015/02/seneca2.jpg'),
(79, 'Pulsera Espiga Puma', NULL, 50.00, 5, NULL, 2, 1, 'https://viancca.com.pe/wp-content/uploads/2021/12/IMG_20211213_161107-scaled.jpg'),
(80, 'Pulsera Puma', NULL, 78.00, 5, NULL, 2, 1, 'https://acdn.mitiendanube.com/stores/804/588/products/picsart_07-08-07-45-271-10887b6bcc226f316c15312397866981-640-0.jpg'),
(81, 'Nike Renew Elevate 3', NULL, 293.93, 3, 2, 3, 1, 'https://images.nike.com/is/image/DotCom/DD9304_101_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(82, 'Cosmic Unity 3', NULL, 749.90, 3, 2, 3, 1, 'https://images.nike.com/is/image/DotCom/DV2757_200_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(83, 'Air Jordan 11 Retro', NULL, 1099.90, 3, 2, 3, 1, 'https://images.nike.com/is/image/DotCom/CT8012_116_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(84, 'Nike Dri-FlT Starting', NULL, 119.92, 2, 2, 3, 1, 'https://images.nike.com/is/image/DotCom/DQ5828_657_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(85, 'Polera sin mangas', NULL, 399.00, 2, 2, 1, 1, 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/1b0d6aad957e431fa5be5865ed2deb71_9366/Polera_sin_mangas_Basketball_Sueded_Beige_IN7704_21_model.jpg'),
(86, 'Zapatillas Trae Young', NULL, 599.00, 3, 2, 1, 1, 'https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/78cca9b62fce4096a8e0024a3db0778e_9366/Zapatillas_Trae_Young_3_Low_Negro_ID8587_01_standard.jpg'),
(87, 'Polo adidas Basketball', NULL, 159.00, 2, 2, 1, 1, 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/00a8443a6c7c4c959ab43ff7096a46aa_9366/Polo_adidas_Basketball_001_Verde_IT4510_21_model.jpg'),
(88, 'BVD Basketball ', NULL, 109.00, 2, 2, 1, 1, 'https://home.ripley.com.pe/Attachment/WOP_5/2016312869837/2016312869837_2.jpg'),
(89, 'Retro Track Jacket', NULL, 95.00, 2, 3, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/files/RetroTrackJacket-GSCamoBrown-GSLinenBrown-GSWashedStoneBrownA4A9V-NB8R-1667_384x.jpg?v=1696606389'),
(90, 'Apex Jacket', NULL, 110.00, 2, 3, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/files/ApexJacket-LightGrey-A3A7X-GBCM-1008_b10e8d3b-a6b9-487b-a677-cb6240b9e328_384x.jpg?v=1692885051'),
(91, 'Vibes Gilet', '', 48.00, 2, 3, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/products/VibesGiletBlackA3A5W-BBBB-1059.105_e3abe5b8-0e17-40e6-8579-cb634c0a3be7_384x.jpg?v=1679304926'),
(92, 'Zapatillas Gamecourt ', NULL, 220.00, 3, 4, 1, 1, 'https://assets.adidas.com/images/w_383,h_383,f_auto,q_auto,fl_lossy,c_fill,g_auto/f9aa3b5470374224b411fdf737ab87c1_9366/zapatillas-gamecourt-2.0-para-tenis.jpg'),
(93, 'Zapatillas Courtflash', NULL, 236.00, 3, 4, 1, 1, 'https://assets.adidas.com/images/w_383,h_383,f_auto,q_auto,fl_lossy,c_fill,g_auto/71cdb1fd2d3a46b398b3b43d18162759_9366/zapatillas-courtflash-speed-para-tenis.jpg'),
(94, 'Zapatillas Defiant', NULL, 339.00, 3, 4, 1, 1, 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/0f84f9ed8b3247dca956c3786b63ae05_9366/Zapatillas_Defiant_Speed_para_Tenis_Turquesa_ID1506_01_standard.jpg'),
(95, 'NikeCourt Dri-FlT', NULL, 239.90, 2, 4, 3, 1, 'https://images.nike.com/is/image/DotCom/DV3046_100_A_PREM?fmt=jpg&bgc=F5F5F5&iccEmbed=1&wid=500&hei=500'),
(96, 'Stripe Crew Single', NULL, 12.00, 2, NULL, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/files/StripeCrewSingle-GSWhite-GSSeafoamBlue-I3A1E-WB7D-0072_fdf68c63-60ec-4ef5-95a8-65a0f4f593f2_384x.jpg?v=1690107746'),
(97, 'Cotton Single', NULL, 16.00, 2, 4, 4, 1, 'https://www.safety-online.co.nz/wp-content/uploads/2023/04/k09035_mlt_3.jpg'),
(98, 'Sharkhead Crew', NULL, 10.50, 2, 4, 4, 1, 'https://cdn.shopify.com/s/files/1/1367/5207/files/PremiumSharkheadCrewSingle-GSDeepOliveGreen-I2A5M-ECBH-0053_edb3cbe9-4aad-4e35-a1a6-ed5e982c357f_384x.jpg?v=1690107755'),
(99, 'Crew Socks 5pk', NULL, 25.00, 2, 4, 4, 1, 'https://th.bing.com/th/id/R.8c50562d0316a200a5ba9c3ae2dc4fb4?rik=8GBg13bGmKi9gw&riu=http%3a%2f%2fcdn.shopify.com%2fs%2ffiles%2f1%2f0185%2f2846%2f9056%2ffiles%2fCrewSocks7PkGSWhiteI3A6U-WB57_a8715989-1d08-4061-a9a8-0ad72726ebe2.jpg%3fv%3d1703160064&ehk=UAg3TRKSEZqDBdVfxqHS5PiS2FxvMc1sDnCpV2hZcVw%3d&risl=&pid=ImgRaw&r=0'),
(100, 'Everyday Holdall', NULL, 60.00, 2, 1, 4, 1, 'https://static.nike.com/a/images/t_default/u_126ab356-44d8-4a06-89b4-fcdcc8df0245,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/106ef990-0215-4995-990a-e8209bea705f/FLIGHT+CARRYALL+TOTE.png'),
(101, 'NikeCourt Air', NULL, 129.99, 3, 4, 3, 1, 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/0bf3df44-4a42-4fc4-9955-6b07fdc0b671/nikecourt-air-zoom-vapor-pro-2-zapatillas-de-tenis-de-pista-rapida-X00X29.png'),
(102, 'NikeCourt Dri-FlT ', NULL, 59.47, 3, 4, 3, 1, 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/823a9e0f-c760-4a52-8447-685adb3a959a/nikecourt-vapor-lite-2-zapatillas-de-tenis-tierra-batida-JkgXdp.png'),
(103, 'NikeCourt Vapor Lite ', NULL, 84.99, 3, 4, 3, 1, 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/5f64e8c2-4948-497a-91a4-5359c553c4c9/nikecourt-vapor-lite-2-zapatillas-de-tenis-de-pista-rapida-ZCt2tv.png'),
(104, 'NikeCourt', NULL, 74.99, 2, 1, 3, 1, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/b37ab836-8d92-46d9-8909-62b5fd8e7114/nikecourt-sudadera-con-capucha-de-tenis-de-tejido-fleece-tZf5ss.png'),
(105, 'NikeCourt Dri-FlT', NULL, 26.97, 2, 2, 3, 1, 'https://static.nike.com/a/images/t_PDP_1728_v1/f_auto,q_auto:eco/689f3efa-db09-446a-a1b1-780f1ced0c31/nikecourt-dri-fit-victory-camiseta-de-tenis-DH29sR.png'),
(106, 'Nike Sportswear', NULL, 31.47, 2, 4, 3, 1, 'https://static.nike.com/a/images/c_limit,w_592,f_auto/t_product_v1/facaf3ba-a7a8-46c0-84e6-519a90aaf7ae/sportswear-polo-5spfwD.png'),
(107, 'Zapatillas Tenis', '', 249.90, 3, 4, 4, 1, 'http://oechsle.vteximg.com.br/arquivos/ids/15784127/2443521.jpg?v=638279326877430000'),
(108, 'Pantalón de Buzo', NULL, 169.90, 2, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/4900208-800-800/1913405.jpg?v=637669409084730000'),
(109, 'Buzo Deportivo', NULL, 169.90, 2, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/16184875-800-800/2458479.jpg?v=638302156704900000'),
(110, 'Zapatillas Urbanas', NULL, 179.00, 3, NULL, NULL, 1, 'https://oechsle.vteximg.com.br/arquivos/ids/15399112-800-800/2391991_1.jpg?v=638282160765600000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuarios` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Correo` varchar(80) NOT NULL,
  `Usurio` varchar(30) NOT NULL,
  `Contraseña` varchar(300) NOT NULL,
  `rol` varchar(255) DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuarios`, `Nombre`, `Correo`, `Usurio`, `Contraseña`, `rol`) VALUES
(25, 'Mariam', 'mariam@umsm.edu.pe', 'Mariam', '$2y$10$4PfqydRSPBurSBLdjkYVoeig95UQ9UpI4WVCnXZVCqkKmigYhylI6', 'usuario'),
(26, 'Alonso', 'U21231837@utp.edu.pe', 'Alonso', '$2y$10$iSj37gBppzLfhRCOfGj2Oe3Vggphe1kcBv5d9mUR7YDVdg0Nx8NdW', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deportes`
--
ALTER TABLE `deportes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `fk_detalles_producto` (`id_producto`);

--
-- Indices de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `fk_historial_usuario` (`usuario_id`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pro_cat` (`id_categoria`),
  ADD KEY `fk_pro_dep` (`id_deporte`),
  ADD KEY `fk_pro_marcass` (`id_marca`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `deportes`
--
ALTER TABLE `deportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `historial_compras` (`id_compra`),
  ADD CONSTRAINT `fk_detalles_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD CONSTRAINT `fk_historial_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`idusuarios`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_pro_cat` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_pro_dep` FOREIGN KEY (`id_deporte`) REFERENCES `deportes` (`id`),
  ADD CONSTRAINT `fk_pro_marcass` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
