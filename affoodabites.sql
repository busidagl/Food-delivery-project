-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 07:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affoodabites`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
      `menu_item_id` int(11) NOT NULL,
        `quantity` int(11) NOT NULL,
          `added_at` timestamp NOT NULL DEFAULT current_timestamp()
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

          -- --------------------------------------------------------

          --
          -- Table structure for table `menu`
          --

          CREATE TABLE `menu` (
            `menu_item_id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
                `description` text NOT NULL,
                  `price` decimal(10,2) NOT NULL,
                    `image` varchar(255) NOT NULL,
                      `category` varchar(100) NOT NULL
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                      --
                      -- Dumping data for table `menu`
                      --

                      INSERT INTO `menu` (`menu_item_id`, `name`, `description`, `price`, `image`, `category`) VALUES
                      (1, 'Margherita Pizza', 'Classic pizza with tomato sauce, mozzarella, and basil.', 12.99, 'margherita_pizza.jpg', 'Pizza'),
                      (2, 'Spaghetti Bolognese', 'Spaghetti with meat sauce, tomatoes, and herbs.', 14.50, 'spaghetti_bolognese.jpg', 'Pasta'),
                      (3, 'Chicken Curry', 'A flavorful Indian curry with tender chicken pieces.', 15.75, 'chicken_curry.jpg', 'Indian'),
                      (4, 'Vegetable Stir-Fry', 'A mix of fresh vegetables stir-fried with soy sauce.', 11.20, 'vegetable_stirfry.jpg', 'Asian'),
                      (5, 'Chocolate Brownie', 'Rich and fudgy chocolate brownie.', 6.50, 'chocolate_brownie.jpg', 'Desserts');

                      -- --------------------------------------------------------

                      --
                      -- Table structure for table `reviews`
                      --

                      CREATE TABLE `reviews` (
                        `review_id` int(11) NOT NULL,
                          `user_id` int(11) NOT NULL,
                            `menu_item_id` int(11) NOT NULL,
                              `rating` int(11) NOT NULL,
                                `comment` text NOT NULL,
                                  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
                                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                                  -- --------------------------------------------------------

                                  --
                                  -- Table structure for table `users`
                                  --

                                  CREATE TABLE `users` (
                                    `user_id` int(11) NOT NULL,
                                      `username` varchar(50) NOT NULL,
                                        `email` varchar(100) NOT NULL,
                                          `password` varchar(255) NOT NULL,
                                            `created_at` timestamp NOT NULL DEFAULT current_timestamp()
                                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                                            --
                                            -- Indexes for dumped tables
                                            --

                                            --
                                            -- Indexes for table `cart`
                                            --
                                            ALTER TABLE `cart`
                                              ADD PRIMARY KEY (`cart_id`),
                                                ADD KEY `user_id` (`user_id`),
                                                  ADD KEY `menu_item_id` (`menu_item_id`);

                                                  --
                                                  -- Indexes for table `menu`
                                                  --
                                                  ALTER TABLE `menu`
                                                    ADD PRIMARY KEY (`menu_item_id`);

                                                    --
                                                    -- Indexes for table `reviews`
                                                    --
                                                    ALTER TABLE `reviews`
                                                      ADD PRIMARY KEY (`review_id`),
                                                        ADD KEY `user_id` (`user_id`),
                                                          ADD KEY `menu_item_id` (`menu_item_id`);

                                                          --
                                                          -- Indexes for table `users`
                                                          --
                                                          ALTER TABLE `users`
                                                            ADD PRIMARY KEY (`user_id`),
                                                              ADD UNIQUE KEY `username` (`username`),
                                                                ADD UNIQUE KEY `email` (`email`);

                                                                --
                                                                -- AUTO_INCREMENT for dumped tables
                                                                --

                                                                --
                                                                -- AUTO_INCREMENT for table `cart`
                                                                --
                                                                ALTER TABLE `cart`
                                                                  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

                                                                  --
                                                                  -- AUTO_INCREMENT for table `menu`
                                                                  --
                                                                  ALTER TABLE `menu`
                                                                    MODIFY `menu_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

                                                                    --
                                                                    -- AUTO_INCREMENT for table `reviews`
                                                                    --
                                                                    ALTER TABLE `reviews`
                                                                      MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

                                                                      --
                                                                      -- AUTO_INCREMENT for table `users`
                                                                      --
                                                                      ALTER TABLE `users`
                                                                        MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

                                                                        --
                                                                        -- Constraints for dumped tables
                                                                        --

                                                                        --
                                                                        -- Constraints for table `cart`
                                                                        --
                                                                        ALTER TABLE `cart`
                                                                          ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
                                                                            ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu` (`menu_item_id`);

                                                                            --
                                                                            -- Constraints for table `reviews`
                                                                            --
                                                                            ALTER TABLE `reviews`
                                                                              ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
                                                                                ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `menu` (`menu_item_id`);
                                                                                COMMIT;

                                                                                /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
                                                                                /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
                                                                                /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;