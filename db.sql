-- phpMyAdmin SQL Dump
-- version 3.2.2
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vygenerováno: Neděle 01. dubna 2012, 13:47
-- Verze MySQL: 5.1.52
-- Verze PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `baku`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `ext_code` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `name` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `status` varchar(8) COLLATE utf8_czech_ci NOT NULL,
  `create_ts` datetime NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
