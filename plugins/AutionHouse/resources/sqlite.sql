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
-- #    { update
-- #        { aution
-- #            { expired
-- #                :id int
-- #                :expired bool
UPDATE Aution SET Expired = :expired WHERE Id = :id;
-- #            }
-- #        }
-- #        { bid
-- #            { price
-- #                :player string
-- #                :id int
-- #                :price float
UPDATE Bid SET Price = :price WHERE (Player = :player) AND (Id = :id);
-- #            }
-- #        }
-- #    }
-- #    { select
-- #        { aution
-- #            { id
-- #                :id int
SELECT * FROM Aution WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT * FROM Aution WHERE Player = :player;
-- #            }
-- #            { all
SELECT * FROM Aution;
-- #            }
-- #            { all.no-expired
SELECT * FROM Aution WHERE Expired = FALSE;
-- #            }
-- #            { all.expired
SELECT * FROM Aution WHERE Expired = TRUE;
-- #            }
-- #        }
-- #        { bid
-- #            { id
-- #                :id int
SELECT * FROM Bid WHERE Id = :id ORDER BY Price;
-- #            }
-- #            { player
-- #                :player string
SELECT * FROM Bid WHERE Player = :player;
-- #            }
-- #        }
-- #    }
-- #}