-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 11, 2023 at 07:41 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arts`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(70) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` enum('admin','employee','customer') NOT NULL DEFAULT 'customer',
  `created_int` date DEFAULT curdate(),
  `verify` int(11) DEFAULT 0,
  `verification_token` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `email`, `password`, `type`, `created_int`, `verify`, `verification_token`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2023-08-02', 1, NULL),

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `delivery_type` varchar(1) DEFAULT 'V',
  `status` enum('order pending','processing order','out for delivery','delivered') DEFAULT 'order pending',
  `courier_number` varchar(40) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_year` int(2) DEFAULT 23,
  `name` varchar(200) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `img` varchar(500) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_year`, `name`, `price`, `description`, `img`, `type`) VALUES
(60007, 19, 'Dotz Brand Customize 3d illusion lamp, 3D Light Lamp, Night Lamp, Decoration Piece, Gift Piece', 895, 'Provides over 50,000 hours immediately of bright light, Includes an energy-efficient LED strip (Saving energy), Beautiful to have at Home or Office, Specifications: Power consumer: 0.012kw.h/24 hours, LED Life: up to 50,000 hours, 3D Illusion Acrylic Plate, Warranty available, Dimensions: 10 Inch, What’s in the box? 3D Lamp Acrylic Plate, Lamp LED Base', 'lamp-1.jpg,lamp-2.jpg,lamp-3.jpg', 'decoration'),
(60008, 20, 'Himalayan Natural Salt Lamp USB Multi-Color 7 Color Changing USB Himalayan Salt Lamp for Home Decoration', 259, 'This Himalayan Salt Lamp features a warm white led that is great for creating a zen or relaxing area or workspace. Can be used as a great night light as well. Product Details: totally zen out with this himalayan salt lamp. this lamp transforms any room into a bohemian paradise & gives off a relaxing, warm colored hue.', 'rock-1.jpg,rock-2.jpg,rock-3.jpg', 'decoration'),
(60009, 23, 'Black Bronzing Greeting Card Thank You Cards Bronzing Invitations Postcard Blessing Message Cards Small Card Blank with Envelope', 332, 'Birthday cards are suitable for people of all ages and genders; you can also make these birthday cards more personalized, contain your unique ideas, and send sincere wishes to your family or friends', 'birthcard-1.jpg,birthcard-2.jpg,birthcard-3.jpg', 'greeting card'),
(60010, 23, 'Small Greeting Card Love Wishing Cards', 200, 'Small cute Love card to give to your loved ones or place on the gift, with blank space inside to write your message and pack in colored envelope.', 'lovecard-1.jpg', 'greeting card'),
(60011, 23, 'Small Greeting Card Love Wishing Cards', 200, 'Small cute Love card to give to your loved ones or place on the gift, with blank space inside to write your message and pack in colored envelope.', 'anotherlovecard-1.jpg', 'greeting card'),
(60012, 23, 'Small Greeting Card Cute Birthday Wishing Cards', 200, 'Small cute birthday card to give to someone or place on the gift, with blank space inside to write your message and pack in colored envelope.', 'birthwish-1.jpg', 'greeting card'),
(60013, 21, '12cm Rebirth Dolls Toys Mini Cute Sleeping Baby Series Doll Cartoon Animal Toys for Girls Birthday Gift', 599, 'Introducing Rebirth Dolls\' 12cm Mini Cute Sleeping Baby Series! These charming cartoon animal toys are an absolute delight for girls. Crafted with love, they make a perfect birthday gift. Compact and cute, they\'re ideal companions for playtime adventures. Spark joy with Rebirth Dolls today!', 'bundoll-1.jpg,bundoll-2.jpg,bundoll-3.jpg', 'doll'),
(60014, 19, 'Frozen - Elsa Classic Doll for Girls - 9 inch', 999, 'Experience the magic of Disney\'s Frozen with the Elsa Classic Doll for Girls! Standing 9 inches tall, she\'s a captivating replica of the beloved character. With her iconic blue gown and poseable arms, she\'s ready for endless adventures. A timeless gift that\'ll warm any heart!', 'frozen-1.jpg,frozen-2.jpg', 'doll'),
(60015, 22, 'New Intelligent Energy Saving Sensor Color Changing Lamp LED Night Lamp Green Plants on the Wall Romantic Colorful Home Decor Baby room', 319, 'Experience love for the mushroom lamp with its charming elements - mushrooms, leaves, a flower, grass in a white ceramic pot - a beautiful potted plant doubling as a lamp, inspired by a popular movie. Lifelike mushrooms and leaves illuminate in Pink, Yellow, and Purple, emitting warm, romantic glow. Energy-efficient LED technology, consuming just 0.2W. Versatile: desk, decoration, night or bedside lamp, and a delightful gift.', 'd34.jpg,d1.jpg,d2.jpg', 'decoration'),
(60016, 20, 'Flying Wooden Birds for Your Kids Bedroom Wall Decoration Ideas & Inspirations', 99, 'Have a blast decorating any room with easy stick solid colored wooden birds. It’s easy to apply on wall and easy to remove and transfer to any other room’s wall. Great for girls room walls or tryin bedroom or kitchen.', 'd3.jpg', 'decoration'),
(60017, 22, 'Pack of 6 Artificial Plants Mini Potted Plant Small Greenery Decor for Indoor Home Farmhouse Aesthetic Bedroom Shelf Office Desk Bathroom Decoration', 299, 'Elevate your indoor spaces with a Pack of 6 Artificial Mini Potted Plants. Lifelike and meticulously detailed, they add a touch of nature to bedrooms, offices, and bathrooms without the need for maintenance. These compact plants fit perfectly on shelves or desks, enhancing the ambiance with their vibrant green hues. With varied plant styles, they bring both aesthetics and convenience, creating a refreshing atmosphere that lasts.', 'd4.jpg,d5.jpg,d6.jpg', 'decoration'),
(60018, 23, '4 Pcs Picture Frame Set Photo (2X 5x7 inches + 2X 4x6 inches )Wall Decoration Photo Frame Wall Hanging Home Decor', 790, 'Modern Minimalist Frame Photo Wall Decoration Photo Frame Wall Hanging Home Decoration Picture Gallery for Living Room Bedroom Study Room. Unique home decor - Amazing Birthday Gift idea- Perfect for home wall, office space, or business inspiration wall decor. This home wall-art decor is to showcase your personal art taste, framed wall art offers a way to incorporate yourself into your home decor. Our framed art pieces come ready to hang. You can hang this framed piece of art the day it arrives!', 'd7.jpg,d8.jpg', 'decoration'),
(60019, 21, 'Urban Vendors Persian Cat Stuffed Toy Meow Sound Animal Soft Cat Plush Toy Cat Cat Stuff Toy White Color Cactus Cat Plush Stuff Toy Birthday Gift 3 Sizes Available 43 cm', 1395, 'Discover the Urban Vendors Persian Cat Stuffed Toy, a soft and charming plush cat in a pristine white color with a playful cactus design. This adorable toy emits a realistic \'meow\' sound, adding to its charm. Available in three sizes, the 43 cm option makes for a perfect birthday gift or a delightful addition to your plush collection.', 'd9.jpg,d10.jpg', 'dolls'),
(60020, 23, 'TRANBO Plastic Expanding Bag File Folder with 13 Section Pockets, Foolscape Size', 849, 'Organize your documents seamlessly with the TRANBO Plastic Expanding Bag File Folder. Designed with 13 section pockets, this foolscap-sized folder offers ample space for your papers. Stay efficient and stylish in your filing.', 'd11.jpg,d12.jpg,d13.jpg', 'files'),
(60021, 23, 'Expanding file folder with Tabs & Handle', 950, 'Very easy to maintain documentsVery very easy to insert documents and out documents from folderConvenient Handler For very easy to CarryingWith Indexing Label. etcused for mulit purpose like saving degrees, certificates, result card etc etc', 'd14.jpg', 'files'),
(60022, 20, 'STICK BAR FILE, For Assignment and Office Folder, A4 Size, PVC Plastic.', 85, 'Optimize your document management with the A4-size PVC Plastic STICK BAR FILE. Perfect for assignments and office use, this folder offers a convenient solution for organizing your materials while maintaining a professional look.', 'd15.jpg,d16.jpg,d17.jpg', 'files'),
(60023, 23, 'Handbag for girls crossbody & Shoulder bag women handbag new stylish handbag new design handbag girls handbag for office use casual handbag leather handbag for girls. KICKZA', 899, 'Introducing the KICKZA Handbag – a versatile and stylish accessory tailored for girls and women alike. This crossbody and shoulder bag boasts a new and trendy design, making it the perfect choice for both office and casual use. Crafted from leather, it exudes sophistication while providing practicality. Elevate your fashion game with this new and chic addition to your collection.', 'd18.jpg', 'hand bag'),
(60024, 22, 'Genuine Leather Men\'s Zipper Coin Purse Wallet For Men Tri-fold Wallet Clasp', 999, 'Experience sophistication and convenience with our Genuine Leather Men\'s Wallet. This tri-fold design features a secure clasp and a dedicated zipper coin purse, combining style and practicality in one. Elevate your accessory game with this versatile wallet, catering to the modern man\'s needs with ease.', 'd19.jpg,d20.jpg,d21.jpg', 'wallets'),
(60025, 23, 'Slim and light weight Long Wallet For Men', 398, 'Discover the ultimate blend of style and convenience with our Slim and Lightweight Long Wallet for Men. Crafted to perfection, this wallet offers a sleek design that easily slips into your pocket. Experience the perfect balance of fashion and functionality in one compact accessory.', 'd22.jpg,d23.jpg', 'wallets'),
(60026, 22, 'New Women Slim Wallet Card Holder Coin Holder Female Mini Wallet Hight Quality PU Leather Small Wallet For Women', 199, 'Elevate your accessory game with the New Women\'s Slim Wallet. This high-quality PU leather wallet combines style and functionality, featuring card and coin holders in a compact design. Experience the luxury of a mini wallet that doesn\'t compromise on quality or elegance, perfectly suited for modern women on the go.', 'd24.jpg,d25.jpg,d26.jpg', 'wallets'),
(60027, 23, 'Stylish mini wallet for girls- Stylish Purse for girls', 499, 'Introducing the Stylish Mini Wallet for Girls – a fashionable and practical accessory that perfectly complements modern trends. This stylish purse offers a compact design while maintaining ample functionality. Elevate your ensemble with this chic addition that\'s tailored to suit the preferences of stylish girls on the move.', 'd27.jpg,d28.jpg,d29.jpg', 'wallets'),
(60028, 22, 'Arfa cosmetics Long Lasting Liquid Full Skin Coverage Soft Matte Foundation Waterproof 40ml', 250, 'Experience flawless beauty with Arfa Cosmetics\' Long Lasting Liquid Full Skin Coverage Soft Matte Foundation. This waterproof formula, available in a 40ml bottle, offers complete coverage and a soft matte finish that lasts. Achieve a radiant complexion that withstands the elements and maintains its allure all day long.', 'd30.jpg', 'cosmetic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80000004;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60029;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
