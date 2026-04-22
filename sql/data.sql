USE DetroitPistonsDB;

-- 1. Departments
INSERT INTO Departments (dept_id, dept_name, manager_id, manager_start_date) VALUES
(1,  'Basketball Operations', NULL, '2024-07-01'),
(2,  'Coaching Staff',        NULL, '2024-07-03'),
(3,  'Player Development',    NULL, '2024-07-05'),
(4,  'Performance Analysis',  NULL, '2024-07-08'),
(5,  'Ticketing',             NULL, '2024-07-10'),
(6,  'Merchandising',         NULL, '2024-07-12'),
(7,  'Finance',               NULL, '2024-07-15'),
(8,  'Arena Operations',      NULL, '2024-07-18'),
(9,  'Medical / Training',    NULL, '2024-07-20'),
(10, 'Media Relations',       NULL, '2024-07-22');


-- 2. Staff
INSERT INTO Staff (staff_id, f_name, l_name, dob, sex, email, job_title, salary, dept_id, sup_id) VALUES
(101, 'Trajan',  'Langdon',    '1976-05-13', 'M', 'trajan.langdon@pistons.com',   'President / General Manager', 2500000.00, 1,  NULL),
(102, 'J.B.',    'Bickerstaff','1979-03-10', 'M', 'jb.bickerstaff@pistons.com',   'Head Coach',                  8000000.00, 2,  101),
(103, 'Jarrett', 'Jack',       '1983-10-28', 'M', 'jarrett.jack@pistons.com',     'Assistant Coach',              500000.00, 2,  102),
(104, 'Fred',    'Vinson',     '1970-08-18', 'M', 'fred.vinson@pistons.com',      'Assistant Coach',              480000.00, 2,  102),
(105, 'Josh',    'Estes',      '1984-04-11', 'M', 'josh.estes@pistons.com',       'Assistant Coach',              420000.00, 3,  102),
(106, 'Alex',    'Garland',    '1987-06-14', 'M', 'alex.garland@pistons.com',     'Trainer',                      210000.00, 9,  101),
(107, 'Jordan',  'Sabourin',   '1989-01-08', 'M', 'jordan.sabourin@pistons.com',  'Strength and Conditioning',    185000.00, 9,  106),
(108, 'Greg',    'Smith',      '1982-09-22', 'M', 'greg.smith@pistons.com',       'Assistant Coach',              390000.00, 3,  102),
(109, 'Luke',    'Walton',     '1980-03-28', 'M', 'luke.walton@pistons.com',      'Assistant Coach',              450000.00, 4,  102),
(110, 'Jerome',  'Allen',      '1973-01-28', 'M', 'jerome.allen@pistons.com',     'Assistant Coach',              400000.00, 10, 102);


-- Update Departments with managers
UPDATE Departments SET manager_id = 101 WHERE dept_id = 1;
UPDATE Departments SET manager_id = 102 WHERE dept_id = 2;
UPDATE Departments SET manager_id = 105 WHERE dept_id = 3;
UPDATE Departments SET manager_id = 109 WHERE dept_id = 4;
UPDATE Departments SET manager_id = 101 WHERE dept_id = 5;
UPDATE Departments SET manager_id = 101 WHERE dept_id = 6;
UPDATE Departments SET manager_id = 101 WHERE dept_id = 7;
UPDATE Departments SET manager_id = 101 WHERE dept_id = 8;
UPDATE Departments SET manager_id = 106 WHERE dept_id = 9;
UPDATE Departments SET manager_id = 110 WHERE dept_id = 10;


-- 3. Players
INSERT INTO Players (player_id, f_name, l_name, dob, height, weight, position, jersey_num, salary, contract_start, contract_end) VALUES
(201, 'Jalen',   'Duren',        '2003-11-18', 82.0, 250, 'C',   0,  8100000.00, '2024-07-01', '2028-06-30'),
(202, 'Cade',    'Cunningham',   '2001-09-25', 78.0, 220, 'G',   2, 13500000.00, '2024-07-01', '2028-06-30'),
(203, 'Ronald',  'Holland II',   '2005-07-07', 80.0, 206, 'F',   5,  6100000.00, '2024-07-01', '2029-06-30'),
(204, 'Paul',    'Reed',         '1999-06-14', 81.0, 210, 'F',   7,  7600000.00, '2024-07-09', '2026-06-30'),
(205, 'Caris',   'LeVert',       '1994-08-25', 79.0, 205, 'G',   8,  9000000.00, '2025-07-07', '2027-06-30'),
(206, 'Ausar',   'Thompson',     '2003-01-30', 79.0, 205, 'G-F', 9,  8500000.00, '2024-07-01', '2028-06-30'),
(207, 'Tobias',  'Harris',       '1992-07-15', 80.0, 226, 'F',   12, 12000000.00, '2024-07-08', '2026-06-30'),
(208, 'Chaz',    'Lanier',       '2001-12-19', 75.0, 206, 'G',   20, 2200000.00, '2025-06-26', '2029-06-30'),
(209, 'Daniss',  'Jenkins',      '2001-08-17', 76.0, 165, 'G',   24, 1900000.00, '2026-02-09', '2026-06-30'),
(210, 'Marcus',  'Sasser',       '2000-09-21', 73.0, 195, 'G',   25, 4200000.00, '2024-07-01', '2026-06-30');


-- 4. Venues
INSERT INTO Venues (venue_id, venue_name, city, state, capacity) VALUES
(301, 'Little Caesars Arena',        'Detroit',      'Michigan',      20000),
(302, 'United Center',               'Chicago',      'Illinois',      20917),
(303, 'Toyota Center',               'Houston',      'Texas',         18055),
(304, 'Rocket Arena',                'Cleveland',    'Ohio',          19432),
(305, 'Kia Center',                  'Orlando',      'Florida',       18846),
(306, 'FedExForum',                  'Memphis',      'Tennessee',     17794),
(307, 'Barclays Center',             'Brooklyn',     'New York',      17732),
(308, 'Wells Fargo Center',          'Philadelphia', 'Pennsylvania',  20478),
(309, 'TD Garden',                   'Boston',       'Massachusetts', 19156),
(310, 'Madison Square Garden',       'New York',     'New York',      19812);


-- 5. Games
INSERT INTO Games (game_id, game_date, opponent, venue_id, home_away, result, score, attendance) VALUES
(401, '2025-10-22', 'Chicago Bulls',      302, 'Away', 'Loss', '111-115', 20917),
(402, '2025-10-24', 'Houston Rockets',    303, 'Away', 'Win',  '115-111', 18055),
(403, '2025-10-26', 'Boston Celtics',     301, 'Home', 'Win',  '119-113', 19112),
(404, '2025-10-27', 'Cleveland Cavaliers',301, 'Home', 'Loss', '95-116',  18876),
(405, '2025-10-29', 'Orlando Magic',      301, 'Home', 'Win',  '135-116', 19040),
(406, '2025-11-01', 'Dallas Mavericks',   301, 'Home', 'Win',  '122-110', 18955),
(407, '2025-11-03', 'Memphis Grizzlies',  306, 'Away', 'Win',  '114-106', 17740),
(408, '2025-11-05', 'Utah Jazz',          301, 'Home', 'Win',  '114-103', 18790),
(409, '2025-11-07', 'Brooklyn Nets',      307, 'Away', 'Win',  '125-107', 17180),
(410, '2025-11-09', 'Philadelphia 76ers', 308, 'Away', 'Win',  '111-108', 19860);


-- 6. PlayerPerformance
INSERT INTO PlayerPerformance (perf_id, game_id, player_id, pts, rebounds, assists, steals, blocks, mins_played, fouls, turnovers) VALUES
(501, 401, 202, 28,  6,  9, 2, 0, 36, 2, 3),
(502, 401, 201, 19, 11,  3, 1, 2, 33, 3, 2),
(503, 402, 207, 16,  7,  2, 1, 0, 31, 4, 2),
(504, 402, 206, 14,  7,  4, 2, 1, 34, 2, 3),
(505, 403, 202, 25,  5,  8, 1, 0, 35, 2, 4),
(506, 404, 203, 18,  6,  2, 1, 1, 30, 4, 1),
(507, 405, 205, 21,  5,  5, 2, 0, 37, 3, 2),
(508, 406, 207, 17,  8,  3, 1, 1, 32, 4, 2),
(509, 407, 204, 15,  6,  2, 2, 1, 29, 3, 1),
(510, 408, 210, 13,  2,  7, 1, 0, 27, 2, 2);


-- 7. Tickets
INSERT INTO Tickets (ticket_id, game_id, seat_num, row_num, section, price, purchase_date, purchaser_fname, purchaser_lname, purchaser_email, ticket_type, sale_status) VALUES
(601, 403, '12', 'A', '101', 145.00, '2025-10-18', 'John',   'Miller',  'john.miller@email.com',   'Standard', 'Sold'),
(602, 403, '13', 'A', '101', 145.00, '2025-10-18', 'John',   'Miller',  'john.miller@email.com',   'Standard', 'Sold'),
(603, 404, '08', 'F', '210',  95.00, '2025-10-21', 'Emily',  'Carter',  'emily.carter@email.com',  'Standard', 'Sold'),
(604, 405, '15', 'D', '118', 110.00, '2025-10-23', 'Marcus', 'Reed',    'marcus.reed@email.com',   'Promo',    'Sold'),
(605, 406, '22', 'C', '115', 120.00, NULL,         NULL,     NULL,      NULL,                       'Standard', 'Available'),
(606, 408, '09', 'G', '214',  90.00, '2025-11-02', 'Tina',   'Lawson',  'tina.lawson@email.com',   'Standard', 'Sold'),
(607, 408, '18', 'B', '102', 150.00, NULL,         NULL,     NULL,      NULL,                       'VIP',      'Reserved'),
(608, 403, '11', 'E', '205',  85.00, '2025-10-19', 'Derek',  'White',   'derek.white@email.com',   'Standard', 'Sold'),
(609, 405, '06', 'A', '100', 175.00, '2025-10-24', 'Olivia', 'Green',   'olivia.green@email.com',  'VIP',      'Sold'),
(610, 406, '25', 'H', '220',  75.00, NULL,         NULL,     NULL,      NULL,                       'Standard', 'Available');


-- 8. Merchandise
INSERT INTO Merchandise (merch_id, item_name, category, price, quantity) VALUES
(701, 'Pistons Home Jersey', 'Apparel',      110.00, 75),
(702, 'Pistons Away Jersey', 'Apparel',      110.00, 60),
(703, 'Team Hoodie',         'Apparel',       70.00, 90),
(704, 'Snapback Cap',        'Accessories',   30.00, 120),
(705, 'Beanie',              'Accessories',   25.00, 80),
(706, 'Courtside Towel',     'Souvenir',      18.00, 200),
(707, 'Mini Basketball',     'Souvenir',      22.00, 150),
(708, 'Water Bottle',        'Accessories',   20.00, 110),
(709, 'Team Backpack',       'Accessories',   55.00, 50),
(710, 'Player Poster Pack',  'Collectibles',  15.00, 140);


-- 9. MerchandiseSales
INSERT INTO MerchandiseSales (sale_id, merch_id, quantity_sold, total_price, sale_date, purchaser_fname, purchaser_lname, purchaser_email) VALUES
(801, 701, 2, 220.00, '2025-10-26', 'John',   'Miller',  'john.miller@email.com'),
(802, 704, 1,  30.00, '2025-10-27', 'Emily',  'Carter',  'emily.carter@email.com'),
(803, 706, 3,  54.00, '2025-10-29', 'Marcus', 'Reed',    'marcus.reed@email.com'),
(804, 703, 1,  70.00, '2025-11-01', 'Tina',   'Lawson',  'tina.lawson@email.com'),
(805, 707, 2,  44.00, '2025-11-03', 'Derek',  'White',   'derek.white@email.com'),
(806, 708, 1,  20.00, '2025-11-05', 'Olivia', 'Green',   'olivia.green@email.com'),
(807, 710, 4,  60.00, '2025-11-07', 'Sam',    'Porter',  'sam.porter@email.com'),
(808, 702, 1, 110.00, '2025-11-08', 'Rachel', 'Adams',   'rachel.adams@email.com'),
(809, 709, 1,  55.00, '2025-11-10', 'Kevin',  'Brooks',  'kevin.brooks@email.com'),
(810, 705, 2,  50.00, '2025-11-12', 'Nina',   'Foster',  'nina.foster@email.com');


-- 10. FinanceRecords
INSERT INTO FinanceRecords (fin_id, dept_id, record_type, amount, record_date, description, status) VALUES
(901,  5, 'Ticket Revenue',      290.00,    '2025-10-26', 'Two lower-bowl tickets sold for Celtics home game', 'Approved'),
(902,  6, 'Merchandise Revenue', 220.00,    '2025-10-26', 'Two home jerseys sold',                              'Approved'),
(903,  6, 'Merchandise Revenue',  30.00,    '2025-10-27', 'One snapback cap sold',                              'Approved'),
(904,  7, 'Payroll Expense', 8000000.00,    '2025-10-31', 'Head coach annual salary allocation',                'Pending'),
(905,  8, 'Arena Expense',     12500.00,    '2025-11-01', 'Lighting and maintenance repairs',                   'Approved'),
(906,  1, 'Travel Expense',     8400.00,    '2025-11-03', 'Road trip transportation and hotel costs',           'Approved'),
(907,  6, 'Inventory Expense',  6500.00,    '2025-11-05', 'Restock for winter merchandise line',                'Pending'),
(908, 10, 'Media Expense',      3200.00,    '2025-11-06', 'Press event and equipment rental',                   'Approved'),
(909,  4, 'Analytics Expense',  2100.00,    '2025-11-08', 'Performance tracking software renewal',              'Canceled'),
(910,  3, 'Development Expense',4700.00,    '2025-11-09', 'Player development equipment purchase',              'Approved');