-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2017-07-16 09:53:12
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `control`
--

-- --------------------------------------------------------

--
-- 表的结构 `con_accounts`
--

CREATE TABLE `con_accounts` (
  `wechat_id` int(10) UNSIGNED NOT NULL,
  `admin_id` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `equipment_id` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wechat_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wechat_password` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wechat_data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `wechat_state` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wechat_Remarks` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `con_equipments`
--

CREATE TABLE `con_equipments` (
  `eq_id` int(10) UNSIGNED NOT NULL,
  `tasks_id` int(10) UNSIGNED NOT NULL,
  `equipments` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tasks_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `tasks_progress` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_equipments`
--

INSERT INTO `con_equipments` (`eq_id`, `tasks_id`, `equipments`, `tasks_name`, `tasks_progress`, `deleted_at`, `created_at`, `updated_at`) VALUES
(28, 18, '手机1', NULL, NULL, NULL, NULL, NULL),
(29, 18, '手机2', NULL, NULL, NULL, NULL, NULL),
(30, 18, '手机3', NULL, NULL, NULL, NULL, NULL),
(32, 19, '设备1', NULL, NULL, NULL, NULL, NULL),
(33, 19, '设备2', NULL, NULL, NULL, NULL, NULL),
(34, 19, '设备3', NULL, NULL, NULL, NULL, NULL),
(35, 20, '123', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `con_journals`
--

CREATE TABLE `con_journals` (
  `log_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_journals`
--

INSERT INTO `con_journals` (`log_id`, `username`, `action`, `ids`, `ip`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'wukai', '登录wukai成功', '1', '::1', NULL, 0x323031372d30372d30362032303a33323a3339, 0x323031372d30372d30362032303a33323a3339),
(2, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032303a33333a3535, 0x323031372d30372d30362032303a33333a3535),
(3, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032303a34313a3534, 0x323031372d30372d30362032303a34313a3534),
(4, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032313a32333a3034, 0x323031372d30372d30362032313a32333a3034),
(5, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032313a32353a3337, 0x323031372d30372d30362032313a32353a3337),
(6, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032313a32353a3536, 0x323031372d30372d30362032313a32353a3536),
(7, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032313a32383a3033, 0x323031372d30372d30362032313a32383a3033),
(8, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032313a32383a3037, 0x323031372d30372d30362032313a32383a3037),
(9, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032313a33303a3238, 0x323031372d30372d30362032313a33303a3238),
(10, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30372030343a32323a3231, 0x323031372d30372d30372030343a32323a3231),
(11, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032313a32363a3136, 0x323031372d30372d30362032313a32363a3136),
(12, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032313a32373a3236, 0x323031372d30372d30362032313a32373a3236),
(13, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032323a31373a3532, 0x323031372d30372d30362032323a31373a3532),
(14, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032323a32323a3136, 0x323031372d30372d30362032323a32323a3136),
(15, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30362032323a32323a3332, 0x323031372d30372d30362032323a32323a3332),
(16, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032323a32323a3436, 0x323031372d30372d30362032323a32323a3436),
(17, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032323a32383a3338, 0x323031372d30372d30362032323a32383a3338),
(18, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30362032323a33323a3530, 0x323031372d30372d30362032323a33323a3530),
(19, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30372031363a33353a3537, 0x323031372d30372d30372031363a33353a3537),
(20, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30382030363a32303a3330, 0x323031372d30372d30382030363a32303a3330),
(21, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d30382030363a32303a3334, 0x323031372d30372d30382030363a32303a3334),
(22, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30382030363a32303a3438, 0x323031372d30372d30382030363a32303a3438),
(23, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d30392030373a34363a3239, 0x323031372d30372d30392030373a34363a3239),
(24, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31312031383a32353a3534, 0x323031372d30372d31312031383a32353a3534),
(25, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a31383a3438, 0x323031372d30372d31312032333a31383a3438),
(26, 'wukai', '用户【2】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a31383a3538, 0x323031372d30372d31312032333a31383a3538),
(27, 'wukai', '用户【3】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a31393a3531, 0x323031372d30372d31312032333a31393a3531),
(28, 'wukai', '用户【4】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a32303a3138, 0x323031372d30372d31312032333a32303a3138),
(29, 'wukai', '用户【5】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a32373a3431, 0x323031372d30372d31312032333a32373a3431),
(30, 'wukai', '用户【6】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33313a3036, 0x323031372d30372d31312032333a33313a3036),
(31, 'wukai', '用户【7】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33333a3035, 0x323031372d30372d31312032333a33333a3035),
(32, 'wukai', '用户【8】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33343a3330, 0x323031372d30372d31312032333a33343a3330),
(33, 'wukai', '用户【9】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33353a3037, 0x323031372d30372d31312032333a33353a3037),
(34, 'wukai', '用户【10】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33363a3039, 0x323031372d30372d31312032333a33363a3039),
(35, 'wukai', '用户【11】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33363a3233, 0x323031372d30372d31312032333a33363a3233),
(36, 'wukai', '用户【12】登录成功', '1', '::1', NULL, 0x323031372d30372d31312032333a33363a3332, 0x323031372d30372d31312032333a33363a3332),
(37, 'wukai', '5', '1', '::1', NULL, 0x323031372d30372d31322030323a30353a3337, 0x323031372d30372d31322030323a30353a3337),
(38, 'wukai', '5', '1', '::1', NULL, 0x323031372d30372d31322030323a30363a3033, 0x323031372d30372d31322030323a30363a3033),
(39, 'wukai', '5', '1', '::1', NULL, 0x323031372d30372d31322030323a30363a3132, 0x323031372d30372d31322030323a30363a3132),
(40, 'wukai', '5', '1', '::1', NULL, 0x323031372d30372d31322030323a30363a3231, 0x323031372d30372d31322030323a30363a3231),
(41, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030323a32393a3031, 0x323031372d30372d31322030323a32393a3031),
(42, 'wukai', '用户【13】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030323a33393a3131, 0x323031372d30372d31322030323a33393a3131),
(43, 'wukai', '用户【14】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030323a33393a3338, 0x323031372d30372d31322030323a33393a3338),
(44, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030343a35303a3038, 0x323031372d30372d31322030343a35303a3038),
(45, 'wukai', '3', '1', '::1', NULL, 0x323031372d30372d31322030353a32353a3233, 0x323031372d30372d31322030353a32353a3233),
(46, 'wukai', '3', '1', '::1', NULL, 0x323031372d30372d31322030353a32353a3534, 0x323031372d30372d31322030353a32353a3534),
(47, 'wukai', '3', '1', '::1', NULL, 0x323031372d30372d31322030353a32363a3238, 0x323031372d30372d31322030353a32363a3238),
(48, 'wukai', '3', '1', '::1', NULL, 0x323031372d30372d31322030353a32373a3133, 0x323031372d30372d31322030353a32373a3133),
(49, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030353a32373a3230, 0x323031372d30372d31322030353a32373a3230),
(50, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030353a32373a3538, 0x323031372d30372d31322030353a32373a3538),
(51, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030353a34373a3037, 0x323031372d30372d31322030353a34373a3037),
(52, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030353a34373a3536, 0x323031372d30372d31322030353a34373a3536),
(53, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d31322030363a32313a3134, 0x323031372d30372d31322030363a32313a3134),
(54, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a32393a3531, 0x323031372d30372d31322030363a32393a3531),
(55, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a33373a3138, 0x323031372d30372d31322030363a33373a3138),
(56, 'wukai', '用户【15】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a34383a3039, 0x323031372d30372d31322030363a34383a3039),
(57, 'wukai', '用户【16】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a34383a3237, 0x323031372d30372d31322030363a34383a3237),
(58, 'wukai', '用户【17】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a34383a3430, 0x323031372d30372d31322030363a34383a3430),
(59, 'wukai', '用户【18】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a34393a3038, 0x323031372d30372d31322030363a34393a3038),
(60, 'wukai', '用户【19】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a34393a3431, 0x323031372d30372d31322030363a34393a3431),
(61, 'wukai', '18', '1', '::1', NULL, 0x323031372d30372d31322030363a35303a3436, 0x323031372d30372d31322030363a35303a3436),
(62, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030363a35313a3035, 0x323031372d30372d31322030363a35313a3035),
(63, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030363a35313a3131, 0x323031372d30372d31322030363a35313a3131),
(64, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030363a35313a3136, 0x323031372d30372d31322030363a35313a3136),
(65, 'wukai', '1', '1', '::1', NULL, 0x323031372d30372d31322030363a35313a3231, 0x323031372d30372d31322030363a35313a3231),
(66, 'wukai', '用户【20】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35313a3435, 0x323031372d30372d31322030363a35313a3435),
(67, 'wukai', '用户【21】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35323a3537, 0x323031372d30372d31322030363a35323a3537),
(68, 'wukai', '用户【22】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35333a3135, 0x323031372d30372d31322030363a35333a3135),
(69, 'wukai', '用户【23】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35333a3430, 0x323031372d30372d31322030363a35333a3430),
(70, 'wukai', '用户【24】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35353a3035, 0x323031372d30372d31322030363a35353a3035),
(71, 'wukai', '用户【25】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35353a3431, 0x323031372d30372d31322030363a35353a3431),
(72, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35353a3534, 0x323031372d30372d31322030363a35353a3534),
(73, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35363a3031, 0x323031372d30372d31322030363a35363a3031),
(74, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35363a3137, 0x323031372d30372d31322030363a35363a3137),
(75, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35363a3338, 0x323031372d30372d31322030363a35363a3338),
(76, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35363a3438, 0x323031372d30372d31322030363a35363a3438),
(77, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35363a3538, 0x323031372d30372d31322030363a35363a3538),
(78, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030363a35373a3036, 0x323031372d30372d31322030363a35373a3036),
(79, 'wukai', '用户【26】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35373a3237, 0x323031372d30372d31322030363a35373a3237),
(80, 'wukai', '用户【27】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35383a3035, 0x323031372d30372d31322030363a35383a3035),
(81, 'wukai', '27', '1', '::1', NULL, 0x323031372d30372d31322030363a35383a3231, 0x323031372d30372d31322030363a35383a3231),
(82, 'wukai', '用户【28】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35383a3535, 0x323031372d30372d31322030363a35383a3535),
(83, 'wukai', '用户【29】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35393a3135, 0x323031372d30372d31322030363a35393a3135),
(84, 'wukai', '27', '1', '::1', NULL, 0x323031372d30372d31322030363a35393a3338, 0x323031372d30372d31322030363a35393a3338),
(85, 'wukai', '用户【30】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030363a35393a3533, 0x323031372d30372d31322030363a35393a3533),
(86, 'wukai', '用户【31】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030373a30303a3331, 0x323031372d30372d31322030373a30303a3331),
(87, 'wukai', '用户【32】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030373a30303a3439, 0x323031372d30372d31322030373a30303a3439),
(88, 'wukai', '27', '1', '::1', NULL, 0x323031372d30372d31322030373a30313a3032, 0x323031372d30372d31322030373a30313a3032),
(89, 'wukai', '用户【33】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030373a30313a3230, 0x323031372d30372d31322030373a30313a3230),
(90, 'wukai', '28', '1', '::1', NULL, 0x323031372d30372d31322030373a30333a3037, 0x323031372d30372d31322030373a30333a3037),
(91, 'wukai', '用户【34】登录成功', '1', '::1', NULL, 0x323031372d30372d31322030373a30333a3333, 0x323031372d30372d31322030373a30333a3333),
(92, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31322030373a30333a3437, 0x323031372d30372d31322030373a30333a3437),
(93, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31332030333a32303a3430, 0x323031372d30372d31332030333a32303a3430),
(94, 'wukai', '用户【35】登录成功', '1', '::1', NULL, 0x323031372d30372d31332030333a32333a3432, 0x323031372d30372d31332030333a32333a3432),
(95, 'wukai', '4', '1', '::1', NULL, 0x323031372d30372d31332030333a32343a3435, 0x323031372d30372d31332030333a32343a3435),
(96, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31332030353a33343a3530, 0x323031372d30372d31332030353a33343a3530),
(97, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d31332030373a34333a3233, 0x323031372d30372d31332030373a34333a3233),
(98, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31332030373a34333a3436, 0x323031372d30372d31332030373a34333a3436),
(99, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31332031353a32383a3339, 0x323031372d30372d31332031353a32383a3339),
(100, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31332031383a32313a3437, 0x323031372d30372d31332031383a32313a3437),
(101, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342030333a33373a3436, 0x323031372d30372d31342030333a33373a3436),
(102, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342030363a30383a3035, 0x323031372d30372d31342030363a30383a3035),
(103, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342031373a33333a3531, 0x323031372d30372d31342031373a33333a3531),
(104, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342031393a34333a3435, 0x323031372d30372d31342031393a34333a3435),
(105, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342032313a30323a3036, 0x323031372d30372d31342032313a30323a3036),
(106, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342032313a35333a3237, 0x323031372d30372d31342032313a35333a3237),
(107, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342032323a34333a3430, 0x323031372d30372d31342032323a34333a3430),
(108, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31342032333a32353a3034, 0x323031372d30372d31342032333a32353a3034),
(109, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31352030353a31353a3532, 0x323031372d30372d31352030353a31353a3532),
(110, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31352031373a34323a3439, 0x323031372d30372d31352031373a34323a3439),
(111, 'wukai', '用户【wukai】登录成功', '1', '::1', NULL, 0x323031372d30372d31352031383a35383a3136, 0x323031372d30372d31352031383a35383a3136),
(112, 'wukai', '用户【36】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33363a3133, 0x323031372d30372d31362030313a33363a3133),
(113, 'wukai', '用户【37】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33363a3339, 0x323031372d30372d31362030313a33363a3339),
(114, 'wukai', '用户【38】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33373a3333, 0x323031372d30372d31362030313a33373a3333),
(115, 'wukai', '用户【39】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33383a3037, 0x323031372d30372d31362030313a33383a3037),
(116, 'wukai', '用户【40】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33383a3438, 0x323031372d30372d31362030313a33383a3438),
(117, 'wukai', '用户【41】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33393a3235, 0x323031372d30372d31362030313a33393a3235),
(118, 'wukai', '用户【42】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a33393a3539, 0x323031372d30372d31362030313a33393a3539),
(119, 'wukai', '用户【43】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34303a3233, 0x323031372d30372d31362030313a34303a3233),
(120, 'wukai', '用户【44】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34313a3130, 0x323031372d30372d31362030313a34313a3130),
(121, 'wukai', '用户【45】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34313a3431, 0x323031372d30372d31362030313a34313a3431),
(122, 'wukai', '用户【46】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34323a3232, 0x323031372d30372d31362030313a34323a3232),
(123, 'wukai', '用户【47】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34333a3032, 0x323031372d30372d31362030313a34333a3032),
(124, 'wukai', '用户【48】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34333a3239, 0x323031372d30372d31362030313a34333a3239),
(125, 'wukai', '用户【49】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34353a3136, 0x323031372d30372d31362030313a34353a3136),
(126, 'wukai', '用户【50】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34353a3532, 0x323031372d30372d31362030313a34353a3532),
(127, 'wukai', '用户【51】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34363a3234, 0x323031372d30372d31362030313a34363a3234),
(128, 'wukai', '用户【52】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a34373a3230, 0x323031372d30372d31362030313a34373a3230),
(129, 'wukai', '3', '1', '::1', NULL, 0x323031372d30372d31362030313a34373a3438, 0x323031372d30372d31362030313a34373a3438),
(130, 'wukai', '2', '1', '::1', NULL, 0x323031372d30372d31362030313a35313a3430, 0x323031372d30372d31362030313a35313a3430),
(131, 'wukai', '退出登录', '1', '::1', NULL, 0x323031372d30372d31362030313a35313a3433, 0x323031372d30372d31362030313a35313a3433),
(132, 'admin', '用户【admin】登录成功', '1', '::1', NULL, 0x323031372d30372d31362030313a35323a3034, 0x323031372d30372d31362030313a35323a3034),
(133, 'admin', '4', '1', '::1', NULL, 0x323031372d30372d31362030313a35323a3337, 0x323031372d30372d31362030313a35323a3337);

-- --------------------------------------------------------

--
-- 表的结构 `con_nodes`
--

CREATE TABLE `con_nodes` (
  `node_id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `nodename` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nav` smallint(5) UNSIGNED NOT NULL DEFAULT '2',
  `auth` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortid` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_nodes`
--

INSERT INTO `con_nodes` (`node_id`, `pid`, `nodename`, `nav`, `auth`, `url`, `sortid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 0, '首页', 2, 'App\\Http\\Controllers\\Index\\IndexController@index', '', 0, NULL, NULL, 0x323031372d30372d31322030323a30363a3231),
(15, 0, '用户管理', 2, '', '', 0, NULL, NULL, NULL),
(16, 15, '用户', 2, '', '', 0, NULL, NULL, NULL),
(18, 16, '编辑', 2, 'App\\Http\\Controllers\\User\\UserController@create', '', 0, NULL, NULL, 0x323031372d30372d31322030363a35303a3436),
(19, 16, '角色', 2, 'App\\Http\\Controllers\\User\\UserController@roles', '', 0, NULL, NULL, NULL),
(20, 16, '角色保存', 2, 'App\\Http\\Controllers\\User\\UserController@rolesPost', '', 0, NULL, NULL, NULL),
(21, 15, '角色', 2, '', '', 0, NULL, NULL, NULL),
(22, 21, '首页', 2, 'App\\Http\\Controllers\\User\\RolesController@index', '', 0, NULL, NULL, NULL),
(23, 21, '添加', 2, 'App\\Http\\Controllers\\User\\RolesController@create', '', 0, NULL, NULL, NULL),
(24, 21, '添加保存', 2, 'App\\Http\\Controllers\\User\\RolesController@store', '', 0, NULL, NULL, NULL),
(25, 21, '权职', 2, 'App\\Http\\Controllers\\User\\NodeController@weight', '', 0, NULL, NULL, NULL),
(26, 21, '权职保存', 2, 'App\\Http\\Controllers\\User\\NodeController@weightPost', '', 0, NULL, NULL, NULL),
(27, 15, '节点', 2, '', '', 0, NULL, NULL, 0x323031372d30372d31322030373a30313a3032),
(28, 27, '首页', 2, 'App\\Http\\Controllers\\User\\NodeController@index', '', 0, NULL, NULL, 0x323031372d30372d31322030373a30333a3037),
(29, 27, '新增', 2, 'App\\Http\\Controllers\\User\\NodeController@create', '', 0, NULL, NULL, NULL),
(31, 27, '新增保存', 2, 'App\\Http\\Controllers\\User\\NodeController@store', '', 0, NULL, NULL, NULL),
(32, 27, '编辑', 2, 'App\\Http\\Controllers\\User\\NodeController@edit', '', 0, NULL, NULL, NULL),
(33, 27, '编辑保存', 2, 'App\\Http\\Controllers\\User\\NodeController@update', '', 0, NULL, NULL, NULL),
(34, 16, '首页', 2, 'App\\Http\\Controllers\\User\\UserController@index', '', 0, NULL, NULL, NULL),
(35, 0, '后台首页', 2, 'App\\Http\\Controllers\\Index\\IndexController@indexPage', '', 0, NULL, NULL, NULL),
(36, 0, '任务管理', 2, '', '', 0, NULL, NULL, NULL),
(37, 0, '账号管理', 2, '', '', 0, NULL, NULL, NULL),
(38, 36, '分组管理', 2, 'App\\Http\\Controllers\\Tasks\\TasksController@index', '', 0, NULL, NULL, NULL),
(39, 38, '添加分组', 2, 'App\\Http\\Controllers\\Tasks\\TasksController@create', '', 0, NULL, NULL, NULL),
(40, 38, '保存分组', 2, 'App\\Http\\Controllers\\Tasks\\TasksController@create', '', 0, NULL, NULL, NULL),
(41, 36, '设备管理', 2, 'App\\Http\\Controllers\\Tasks\\TasksController@show', '', 0, NULL, NULL, NULL),
(42, 36, '配置管理', 2, 'App\\Http\\Controllers\\Tasks\\TasksconfigureController@index', '', 0, NULL, NULL, NULL),
(43, 42, '添加配置', 2, 'App\\Http\\Controllers\\Tasks\\TasksconfigureController@create', '', 0, NULL, NULL, NULL),
(44, 42, '保存配置', 2, 'App\\Http\\Controllers\\Tasks\\TasksconfigureController@create', '', 0, NULL, NULL, NULL),
(45, 42, '编辑配置', 2, 'App\\Http\\Controllers\\Tasks\\TasksconfigureController@edit', '', 0, NULL, NULL, NULL),
(46, 42, '配置编辑保存', 2, 'App\\Http\\Controllers\\Tasks\\TasksconfigureController@update', '', 0, NULL, NULL, NULL),
(47, 36, '任务管理', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@index', '', 0, NULL, NULL, NULL),
(48, 47, '添加任务', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@create', '', 0, NULL, NULL, NULL),
(49, 47, '保存任务', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@create', '', 0, NULL, NULL, NULL),
(50, 47, '编辑任务', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@edit', '', 0, NULL, NULL, NULL),
(51, 47, '保存编辑', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@edit', '', 0, NULL, NULL, NULL),
(52, 47, '更新任务状态', 2, 'App\\Http\\Controllers\\Tasks\\TaskscontentController@state', '', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `con_roles`
--

CREATE TABLE `con_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `rolename` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_roles`
--

INSERT INTO `con_roles` (`role_id`, `pid`, `rolename`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, 0, '管理员', NULL, 0x323031372d30372d30382030313a34383a3431, 0x323031372d30372d30382030313a34383a3431),
(4, 3, '超级管理员', NULL, 0x323031372d30372d30382030313a35313a3232, 0x323031372d30372d30382030313a35313a3232);

-- --------------------------------------------------------

--
-- 表的结构 `con_tasksconfigures`
--

CREATE TABLE `con_tasksconfigures` (
  `config_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `config_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_config` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `config_images` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_tasksconfigures`
--

INSERT INTO `con_tasksconfigures` (`config_id`, `admin_id`, `config_name`, `config_config`, `config_images`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 1, '测试', '上传,大小,等级', '0', NULL, 0x323031372d30372d31352031383a34313a3137, 0x323031372d30372d31352031383a34313a3137),
(9, 1, '123', '123', '0', NULL, 0x323031372d30372d31362030313a34303a3333, 0x323031372d30372d31362030313a34303a3333);

-- --------------------------------------------------------

--
-- 表的结构 `con_taskscontents`
--

CREATE TABLE `con_taskscontents` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `tasks_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_config` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_number` char(100) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `content_complete` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `content_status` char(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_taskscontents`
--

INSERT INTO `con_taskscontents` (`content_id`, `admin_id`, `tasks_id`, `content_name`, `content_config`, `content_number`, `content_complete`, `content_status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(11, 1, '19', '测试', '上传:1;大小:3;等级:123;', '120', '0', '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `con_tasksgroups`
--

CREATE TABLE `con_tasksgroups` (
  `tasks_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(255) NOT NULL,
  `tasksgroup_name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_tasksgroups`
--

INSERT INTO `con_tasksgroups` (`tasks_id`, `admin_id`, `tasksgroup_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(19, 1, '测试', NULL, 0x323031372d30372d31352031383a34303a3339, 0x323031372d30372d31352031383a34303a3339),
(20, 1, '123', NULL, 0x323031372d30372d31362030313a33383a3139, 0x323031372d30372d31362030313a33383a3139);

-- --------------------------------------------------------

--
-- 表的结构 `con_users`
--

CREATE TABLE `con_users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `ban` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `con_users`
--

INSERT INTO `con_users` (`user_id`, `username`, `password`, `salt`, `ban`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'wukai', '$2y$10$AZGQZ5sdyr/FJwHncjUC2e237a1P7N6hiRMc.9GpweGLHB1nYhb82', '', 1, NULL, NULL, 0x323031372d30372d31322030363a35323a3235),
(2, 'admin', '$2y$10$piW7bNDaRr.ncJsN2FSUD.pfAEPn2DHbnPozdCGG5YYCQFlQFLKB6', '', 1, NULL, NULL, 0x323031372d30372d31362030313a35313a3139);

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_07_07_034530_create_con_users_table', 1),
(2, '2017_07_07_042953_create_con_journals_table', 2),
(4, '2017_07_07_071845_create_con_roles_table', 3),
(5, '2017_07_12_024053_create_con_nodes_table', 4),
(6, '2017_06_03_174437_create_role_node', 5),
(7, '2017_06_05_094907_create_user_role', 5),
(9, '2017_07_13_120909_create_tasks_table', 6),
(11, '2017_07_13_122039_create_con_equipments_table', 7),
(13, '2017_07_14_114753_create_tasksconfigures_table', 8),
(14, '2017_07_14_133135_create_con_taskscontents_table', 9),
(15, '2017_07_16_083956_create_con_accounts_table', 10);

-- --------------------------------------------------------

--
-- 表的结构 `role_node`
--

CREATE TABLE `role_node` (
  `role_node_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `node_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `role_node`
--

INSERT INTO `role_node` (`role_node_id`, `role_id`, `node_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(166, 4, 5, NULL, NULL, NULL),
(167, 4, 15, NULL, NULL, NULL),
(168, 4, 16, NULL, NULL, NULL),
(169, 4, 18, NULL, NULL, NULL),
(170, 4, 19, NULL, NULL, NULL),
(171, 4, 20, NULL, NULL, NULL),
(172, 4, 34, NULL, NULL, NULL),
(173, 4, 21, NULL, NULL, NULL),
(174, 4, 22, NULL, NULL, NULL),
(175, 4, 23, NULL, NULL, NULL),
(176, 4, 24, NULL, NULL, NULL),
(177, 4, 25, NULL, NULL, NULL),
(178, 4, 26, NULL, NULL, NULL),
(179, 4, 27, NULL, NULL, NULL),
(180, 4, 28, NULL, NULL, NULL),
(181, 4, 29, NULL, NULL, NULL),
(182, 4, 31, NULL, NULL, NULL),
(183, 4, 32, NULL, NULL, NULL),
(184, 4, 33, NULL, NULL, NULL),
(185, 4, 35, NULL, NULL, NULL),
(186, 4, 36, NULL, NULL, NULL),
(187, 4, 38, NULL, NULL, NULL),
(188, 4, 39, NULL, NULL, NULL),
(189, 4, 40, NULL, NULL, NULL),
(190, 4, 41, NULL, NULL, NULL),
(191, 4, 42, NULL, NULL, NULL),
(192, 4, 43, NULL, NULL, NULL),
(193, 4, 44, NULL, NULL, NULL),
(194, 4, 45, NULL, NULL, NULL),
(195, 4, 46, NULL, NULL, NULL),
(196, 4, 47, NULL, NULL, NULL),
(197, 4, 48, NULL, NULL, NULL),
(198, 4, 49, NULL, NULL, NULL),
(199, 4, 50, NULL, NULL, NULL),
(200, 4, 51, NULL, NULL, NULL),
(201, 4, 52, NULL, NULL, NULL),
(202, 4, 37, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_id`, `role_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(7, 1, 4, NULL, NULL, NULL),
(8, 2, 4, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `con_accounts`
--
ALTER TABLE `con_accounts`
  ADD PRIMARY KEY (`wechat_id`);

--
-- Indexes for table `con_equipments`
--
ALTER TABLE `con_equipments`
  ADD PRIMARY KEY (`eq_id`);

--
-- Indexes for table `con_journals`
--
ALTER TABLE `con_journals`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `con_nodes`
--
ALTER TABLE `con_nodes`
  ADD PRIMARY KEY (`node_id`);

--
-- Indexes for table `con_roles`
--
ALTER TABLE `con_roles`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `con_roles_rolename_index` (`rolename`);

--
-- Indexes for table `con_tasksconfigures`
--
ALTER TABLE `con_tasksconfigures`
  ADD PRIMARY KEY (`config_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `con_taskscontents`
--
ALTER TABLE `con_taskscontents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `con_tasksgroups`
--
ALTER TABLE `con_tasksgroups`
  ADD PRIMARY KEY (`tasks_id`),
  ADD UNIQUE KEY `tasks_name` (`tasksgroup_name`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `con_users`
--
ALTER TABLE `con_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `con_users_username_unique` (`username`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_node`
--
ALTER TABLE `role_node`
  ADD PRIMARY KEY (`role_node_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `con_accounts`
--
ALTER TABLE `con_accounts`
  MODIFY `wechat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `con_equipments`
--
ALTER TABLE `con_equipments`
  MODIFY `eq_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- 使用表AUTO_INCREMENT `con_journals`
--
ALTER TABLE `con_journals`
  MODIFY `log_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- 使用表AUTO_INCREMENT `con_nodes`
--
ALTER TABLE `con_nodes`
  MODIFY `node_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- 使用表AUTO_INCREMENT `con_roles`
--
ALTER TABLE `con_roles`
  MODIFY `role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `con_tasksconfigures`
--
ALTER TABLE `con_tasksconfigures`
  MODIFY `config_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `con_taskscontents`
--
ALTER TABLE `con_taskscontents`
  MODIFY `content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- 使用表AUTO_INCREMENT `con_tasksgroups`
--
ALTER TABLE `con_tasksgroups`
  MODIFY `tasks_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `con_users`
--
ALTER TABLE `con_users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `role_node`
--
ALTER TABLE `role_node`
  MODIFY `role_node_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- 使用表AUTO_INCREMENT `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
