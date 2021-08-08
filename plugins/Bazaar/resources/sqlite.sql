-- #! sqlite
-- #{ bazaar
-- #    { init
CREATE TABLE IF NOT EXISTS BuyOrder (
    Id INT UNSIGNED AUTOINCREMENT PRIMARY KEY,
    Player VARCHAR(40) NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Amount INT UNSIGNED NOT NULL DEFAULT 0,
    ItemID INT UNSIGNED NOT NULL DEFAULT 0,
    Time INT UNSIGNED NOT NULL DEFAULT 0
);
CREATE TABLE IF NOT EXISTS SellOrder (
    Id INT UNSIGNED AUTOINCREMENT PRIMARY KEY,
    Player VARCHAR(40) NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Amount INT UNSIGNED NOT NULL DEFAULT 0,
    ItemID INT UNSIGNED NOT NULL DEFAULT 0,
    Time INT UNSIGNED NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #        { buy
-- #            :player string
-- #            :price int
-- #            :amount int
-- #            :itemID int
-- #            :time int
INSERT OR REPLACE INTO BuyOrder (
    Player,
    Price,
    Amount,
    ItemID,
    Time
) VALUES (
    :player,
    :price,
    :amount,
    :itemID,
    :time
);
-- #        }
-- #        { sell
-- #            :player string
-- #            :price int
-- #            :amount int
-- #            :itemID int
-- #            :time int
INSERT OR REPLACE INTO SellOrder (
    Player,
    Price,
    Amount,
    ItemID,
    Time
) VALUES (
    :player,
    :price,
    :amount,
    :itemID,
    :time
         );
-- #        }
-- #    }
-- #    { remove
-- #        { buy
-- #            :id int
DELETE FROM BuyOrder WHERE Id = :id;
-- #        }
-- #        { sell
-- #            :id int
DELETE FROM SellOrder WHERE Id = :id;
-- #        }
-- #    }
-- #}