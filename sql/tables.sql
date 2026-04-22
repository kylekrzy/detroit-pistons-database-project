DROP DATABASE IF EXISTS DetroitPistonsDB;
CREATE DATABASE DetroitPistonsDB;
USE DetroitPistonsDB;

-- 1. DEPARTMENTS
CREATE TABLE Departments (
    dept_id INT PRIMARY KEY,
    dept_name VARCHAR(100) NOT NULL,
    manager_id INT NULL,
    manager_start_date DATE NULL
);

-- 2. STAFF
CREATE TABLE Staff (
    staff_id INT PRIMARY KEY,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    sex CHAR(1) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    job_title VARCHAR(100) NOT NULL,
    salary DECIMAL(12,2) NOT NULL,
    dept_id INT NOT NULL,
    sup_id INT NULL,

    CONSTRAINT chk_staff_sex CHECK (sex IN ('M', 'F')),
    CONSTRAINT chk_staff_salary CHECK (salary>=0),
    CONSTRAINT fk_staff_department
        FOREIGN KEY (dept_id) REFERENCES Departments(dept_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_staff_supervisor
        FOREIGN KEY (sup_id) REFERENCES Staff(staff_id) ON UPDATE CASCADE ON DELETE SET NULL
);

ALTER TABLE Departments
ADD CONSTRAINT fk_department_manager
    FOREIGN KEY (manager_id) REFERENCES Staff(staff_id) ON UPDATE CASCADE ON DELETE SET NULL;


-- 3. PLAYERS
CREATE TABLE Players (
    player_id INT PRIMARY KEY,
    f_name VARCHAR(50) NOT NULL,
    l_name VARCHAR(50) NOT NULL,
    dob DATE NOT NULL,
    height DECIMAL(4,1) NOT NULL,
    weight INT NOT NULL,
    position VARCHAR(20) NOT NULL,
    jersey_num INT NOT NULL,
    salary DECIMAL(12,2) NOT NULL,
    contract_start DATE NOT NULL,
    contract_end DATE NOT NULL,
    CONSTRAINT chk_player_height CHECK (height > 0),
    CONSTRAINT chk_player_weight CHECK (weight > 0),
    CONSTRAINT chk_player_salary CHECK (salary >= 0),
    CONSTRAINT chk_player_contract_dates CHECK (contract_end >= contract_start)
);

-- 4. VENUES
CREATE TABLE Venues (
    venue_id INT PRIMARY KEY,
    venue_name VARCHAR(100) NOT NULL,
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    capacity INT NOT NULL,
    CONSTRAINT chk_venue_capacity CHECK (capacity > 0)
);

-- 5. GAMES
CREATE TABLE Games (
    game_id INT PRIMARY KEY,
    game_date DATE NOT NULL,
    opponent VARCHAR(100) NOT NULL,
    venue_id INT NOT NULL,
    home_away VARCHAR(10) NOT NULL,
    result VARCHAR(10) NOT NULL,
    score VARCHAR(20) NOT NULL,
    attendance INT NOT NULL,
    CONSTRAINT chk_game_home_away CHECK (home_away IN ('Home', 'Away')),
    CONSTRAINT chk_game_result CHECK (result IN ('Win', 'Loss')),
    CONSTRAINT chk_game_attendance CHECK (attendance >= 0),
    CONSTRAINT fk_game_venue
        FOREIGN KEY (venue_id) REFERENCES Venues(venue_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

-- 6. PLAYER PERFORMANCE
CREATE TABLE PlayerPerformance (
    perf_id INT PRIMARY KEY,
    game_id INT NOT NULL,
    player_id INT NOT NULL,
    pts INT NOT NULL,
    rebounds INT NOT NULL,
    assists INT NOT NULL,
    steals INT NOT NULL,
    blocks INT NOT NULL,
    mins_played INT NOT NULL,
    fouls INT NOT NULL,
    turnovers INT NOT NULL,
    CONSTRAINT chk_performance_pts CHECK (pts >= 0),
    CONSTRAINT chk_performance_rebounds CHECK (rebounds >= 0),
    CONSTRAINT chk_performance_assists CHECK (assists >= 0),
    CONSTRAINT chk_performance_steals CHECK (steals >= 0),
    CONSTRAINT chk_performance_blocks CHECK (blocks >= 0),
    CONSTRAINT chk_performance_mins_played CHECK (mins_played >= 0),
    CONSTRAINT chk_performance_fouls CHECK (fouls >= 0),
    CONSTRAINT chk_performance_turnovers CHECK (turnovers >= 0),
    CONSTRAINT fk_perf_game
        FOREIGN KEY (game_id) REFERENCES Games(game_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_perf_player
        FOREIGN KEY (player_id) REFERENCES Players(player_id) ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT uq_perf_game_player UNIQUE (game_id, player_id)
);

-- 7. Tickets
CREATE TABLE Tickets (
    ticket_id INT PRIMARY KEY,
    game_id INT NOT NULL,
    seat_num VARCHAR(10) NOT NULL,
    row_num VARCHAR(10) NOT NULL,
    section VARCHAR(20) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    purchase_date DATE NULL,
    purchaser_fname VARCHAR(50) NULL,
    purchaser_lname VARCHAR(50) NULL,
    purchaser_email VARCHAR(100) NULL,
    ticket_type VARCHAR(30) NOT NULL,
    sale_status VARCHAR(20) NOT NULL,
    CONSTRAINT chk_ticket_price CHECK (price >= 0),
    CONSTRAINT chk_tickets_status CHECK (sale_status IN ('Available', 'Sold', 'Reserved')),
    CONSTRAINT fk_tickets_game
        FOREIGN KEY (game_id) REFERENCES Games(game_id) ON UPDATE CASCADE ON DELETE CASCADE
);

-- 8. Merchandise
CREATE TABLE Merchandise (
    merch_id INT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(8,2) NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT chk_merch_price CHECK (price >= 0),
    CONSTRAINT chk_merch_quantity CHECK (quantity >= 0)
);

-- 9. Merchandise Sales
CREATE TABLE MerchandiseSales (
    sale_id INT PRIMARY KEY,
    merch_id INT NOT NULL,
    quantity_sold INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    sale_date DATE NOT NULL,
    purchaser_fname VARCHAR(50) NULL,
    purchaser_lname VARCHAR(50) NULL,
    purchaser_email VARCHAR(100) NULL,
    CONSTRAINT chk_sales_quantity CHECK (quantity_sold > 0),
    CONSTRAINT chk_sales_total_price CHECK (total_price >= 0),
    CONSTRAINT fk_sales_merch
        FOREIGN KEY (merch_id) REFERENCES Merchandise(merch_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

-- 10. Finance Records
CREATE TABLE FinanceRecords (
    fin_id INT PRIMARY KEY,
    dept_id INT NOT NULL,
    record_type VARCHAR(50) NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    record_date DATE NOT NULL,
    description VARCHAR(255) NULL,
    status VARCHAR(20) NOT NULL,
    CONSTRAINT chk_finance_amount CHECK (amount >= 0),
    CONSTRAINT chk_finance_status CHECK (status IN ('Pending', 'Approved', 'Canceled')),
    CONSTRAINT fk_finance_department
        FOREIGN KEY (dept_id) REFERENCES Departments(dept_id) ON UPDATE CASCADE ON DELETE RESTRICT
);
