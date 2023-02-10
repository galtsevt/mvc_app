   SELECT email, COUNT(*) AS count
   FROM users
   GROUP BY email
   HAVING count > 1;

   SELECT `users`.`login`, COUNT(`orders`.`id`) as orders
   FROM `users`
   LEFT JOIN `orders` ON `users`.`id` = `orders`.`user_id`
   GROUP BY `users`.`id` HAVING orders = 0;

   SELECT `users`.`login`, COUNT(`orders`.`id`) as orders
   FROM `users`
   LEFT JOIN `orders` ON `users`.`id` = `orders`.`user_id`
   GROUP BY `users`.`id` HAVING orders > 1;

