USE DetroitPistonsDB;
-- Question 1:
-- Show all players and their jersey numbers.
SELECT player_id, f_name, l_name, jersey_num
FROM Players;

-- Question 2:
-- Show all players ordered by salary from highest to lowest.
SELECT player_id, f_name, l_name, salary
FROM Players
ORDER BY salary DESC;

-- Question 3:
-- Show all staff members who work in department 2.
SELECT staff_id, f_name, l_name, job_title, dept_id
FROM Staff
WHERE dept_id = 2;

-- Question 4:
-- Show all home games.
SELECT game_id, game_date, opponent, score, result
FROM Games
WHERE home_away = 'Home';

-- Question 5:
-- Show all player performance records where a player scored 20 or more points.
SELECT perf_id, game_id, player_id, pts, rebounds, assists
FROM PlayerPerformance
WHERE pts >= 20;

-- Question 6:
-- Show all tickets that are still available.
SELECT ticket_id, game_id, section, row_num, seat_num, price
FROM Tickets
WHERE sale_status = 'Available';

-- Question 7:
-- Find the total ticket revenue from sold tickets.
SELECT SUM(price) AS total_ticket_revenue
FROM Tickets
WHERE sale_status = 'Sold';

-- Question 8:
-- Show all merchandise items with quantity less than 100.
SELECT merch_id, item_name, category, quantity
FROM Merchandise
WHERE quantity < 100;

-- Question 9:
-- Find the total merchandise revenue from all merchandise sales.
SELECT SUM(total_price) AS total_merchandise_revenue
FROM MerchandiseSales;

-- Question 10:
-- Show all finance records with status = 'Pending'.
SELECT fin_id, dept_id, record_type, amount, record_date, status
FROM FinanceRecords
WHERE status = 'Pending';