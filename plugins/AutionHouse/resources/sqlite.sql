-- #! sqlite
-- #{ aution
-- #    { init
-- #        { aution
CREATE TABLE IF NOT EXISTS Aution(
    Id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    Player VARCHAR(40) NOT NULL,
    Item BLOB NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Time INTEGER NOT NULL DEFAULT 0,
    Expired BOOLEAN NOT NULL DEFAULT FALSE
);
-- #        }
-- #        { bid
CREATE TABLE IF NOT EXISTS Bid(
    Player VARCHAR(40) NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Id INTEGER NOT NULL DEFAULT 0
);
-- #        }
-- #    }
-- #    { remove
-- #        { aution
-- #            :id int
DELETE FROM Aution WHERE Id = :id;
-- #        }
-- #        { bid
-- #            :id int
DELETE FROM Bid WHERE Id = :id;
-- #        }
-- #    }
-- #    { register
-- #        { aution
-- #            :player string
-- #            :item string
-- #            :price floats
-- #            :time int
INSERT OR REPLACE INTO Aution(Player, Item, Price, Time) VALUES (:player, :item, :price, :time);
-- #        }
-- #        { bid
-- #            :player string
-- #            :price float
-- #            :id int
INSERT OR REPLACE INTO Bid(Player, Price, Id) VALUES (:player, :price, :id);
-- #        }
-- #    }
-- #}