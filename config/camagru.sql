-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 25, 2016 at 07:46 PM
-- Server version: 5.6.28
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` varchar(141) NOT NULL,
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `img_id`, `user_id`) VALUES
(1, 'dawwda', 1, 1),
(2, 'dwadwa', 1, 1),
(3, 'dwadwa', 4, 1),
(4, 'dwadwaad', 4, 1),
(5, 'awdwddawaw', 2, 1),
(6, 'dwawa', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `user_id`) VALUES
(1, '60bu7m92lfnuqp70ynnpzuxvgtkb2ag9ar3iedk0s7uix1jwp7lp2ikic4uefbop3r8i5six0dgye0u47fu9yesajmpzxdp15xja', 1),
(2, 'q18qepptqjyxzs7x7z7rmxqkaflgc4q36ztlpjff2ec16kyek6563vqebcuohlrnll8a4oq62389n7n7esdho4w0hroydflz1u95', 1),
(3, 'izck2kuqshx6abozgkzxcovq4hp5czbuznf289s1rq712v0ig0gtocjtt8y58a07yg96q18hsfiubjdsktl9542zd15lb6s9m2gc', 1),
(4, 'ocqsxoc06biauxefbz5j0hr5o4rszymnbdg81s984riyoxe0wjjx0b3pguhfs423hjcjclsgcbf08t15dk2ev53bzkqsptv7d7rq', 1),
(5, 'tj65um62g77tsa7ofa0fvr8kl3rzbip52wawihzyo7shhz5x96d5xlqipih117633h0my0kn7c5pcbnmh0remhxc0fe1nk4q24c0', 1),
(6, '4xocat2m4p9lq10diypje3k1oosqt4ry2fbc9dze380t906szvbezwgnl8dfd5eflpsu3s8608za96392fo1b4owd2bq8p6tfzoi', 1),
(7, 'rxor6o2fu6pwleywimtvp5mxvtrasftjcibi6dy1joy52w2kjvg9137wxy6pe08qik9ox7qhvonylpi5lzem3li0kpqypyo8jywg', 1),
(8, '5ny1clzxbi3wihim31mnqcmgbaou9lbe9aglwgj7ym3h4l37mqvd3huesj915lgevw0rcjyb62sanwiamdopvj4o2dq7z6mu3mmg', 1),
(9, '5krbmkmah4l3i9tesy2vcs2bzo52brjgcaszvfadkvh35ahy8ktldwwdl2fwtyd69655lgi5bz9gaqejb84p412p3hlxgy3q49wq', 1),
(10, 'pew1e5howw874dw9ezyhgkexjhonrkegzahegz3cwbk0oha2g8jxsyvbgjz74en3o5i54lh1w12licozk8wd6rpmbptf3hjsm1xr', 1),
(11, 'mfsjgu4z7szr0v57nutykndn4wgrydiksb39689d08514b8r62pqp3et0uky83i1emalukzvs4wxf5ol7ecwhqphkagsdytsl4df', 1),
(12, 'odahh7fxc3jjhvgzm5h6gxztwtlhyzxnd85ufkssncc58s5uym1ek07gutystvf63k1j4ubs7nyfg49eqatbb1r5vqyoldvpyx83', 1),
(13, 'skwz7vfozo2qzv1bwthsjfh5tdusa2v3ms3uniim7lc7hdie706qfnv90p1bsxefpi9c0sy8dbfuoy9wyfme2io38pe0ntfdbppc', 1),
(14, 'holvz0qozzkxe7chp0kxqzydsdq43ghl42g436t25d0klc1acm82l6gek7ionz9s2pw5wp7138mokozxa80wfha0osobsx3um0zi', 1),
(15, 'p7ktf7i0vhy6qy35fd546tfzrjuejux91h2hpkil2gstfvzv94zgyfgqya4i41r6jun8f6tinmb2hayrfy7edo4cy8u29m9thw1x', 1),
(16, '3vfqhrtz1rqhqyw3m0gl9bojyxcfuecx9sorjhql9h2zgz33zko9vdsta594jl1teqkx8bihtlh9kldk52t0fmupr3tbpv43mp1u', 1),
(17, '0jbt5t3pegaki4lxrfnjjhu8czcyodsow4i2ymsc22xl6ijxx6hgobp0a2zyfsncx6evs68v95ggo0em7v3v6swhuvgao4mma0h2', 1),
(18, '7qxgwexkeb6l69gd2dvx8b7xftkpu1s2sqjo5g9jrf5ypmcsz7p8iw6ypqoksgmk759cmiwey1doopgnw5wf22dst1cliz6p5f2r', 1),
(21, 'wq84okpu15yo1ke1unca1qz0pte5fcjb2rgqc5ldbk2d4gfz4r95h9673kdiwwuyoap1gbfrwh40yj02b98sje0mye5uaztzaj1r', 1),
(22, 'kbgj90jsrlr1tqr5rsphac82wfb3o328eirojbhbw8cpy3vqvk76xg8uwkxko0t3ilr2w8dsgpiftd6pydwvu5pqpnben4i6pa8m', 1),
(23, 'imfzcyf5clvazr6twwkmkw171jertmdc9sclqsr2dmdddk7agsw1ox8pgnga9unjmz4drvg5iujveq5vi2w7z5xgsdr27eludq85', 1),
(24, 'loa3itzwk5s38pa7u7onlfpttbn71vcnknr2hrz2xs55hgdbo1zahp3b0ri2nvp7jha0893528bjpoudqun7jqjji2m5xcchtmh2', 1),
(25, 'wl8ytjii7dwx7k5qboatqwyo8b51yn3u8bt2vcl2ph0w15mctw5kt481fd3d1789j2beewg3egzfmmsfjy0c28eimhvno4w868mk', 1),
(26, '43ojknz6armuqm7tulbg374sb00h9m2eqqxaewgpo2jepr7jcj0gq58259kfwmtmdqwrndgbg0q5ryp4hql8vua13ugzhamu0jlo', 1),
(27, 'x20d3qjvp806ylfufpvjkbj1l5vmphbmkb0n2jjrsjyr4dlk3g3nsmoesj1h0d4kp48rnrjgbi7fws0z93m2qahiuj0vw4gl8pdw', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `img_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `img_id`, `user_id`) VALUES
(1, 7, 1),
(16, 2, 1),
(17, 4, 1),
(18, 1, 1),
(19, 3, 1),
(20, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(129) NOT NULL,
  `token_email` varchar(129) DEFAULT NULL,
  `token_password` varchar(129) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `token_email`, `token_password`, `active`) VALUES
(1, 'tommy', 'tommy.pageard@gmail.com', 'fa1b844d917c7a061287eeed319ee603f880e8778f840197a8ade913a4557bec0a88be0e973b5e770cd182e4c8cf43269d5690d7040df2f203e85a27578d3a0d', '', '', 1),
(3, 'radia', 'qarcher@student.42.fr', 'f676fdfecacb82eba8474c31496d2bab609dd03191dec3b5b570d697235865c11f8126d6aff1e6e3578a3474cadf1bf889211163b23338e7ef106340a12919d8', '', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
