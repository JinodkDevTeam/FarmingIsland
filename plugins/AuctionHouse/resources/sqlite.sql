-- #! sqlite
-- #{ auction
-- #    { init
-- #        { auction
CREATE TABLE IF NOT EXISTS Auction(
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
-- #        { auction
-- #            :id int
DELETE FROM Auction WHERE Id = :id;
-- #        }
-- #        { bid
-- #            :id int
DELETE FROM Bid WHERE Id = :id;
-- #        }
-- #    }
-- #    { register
-- #        { auction
-- #            :player string
-- #            :item string
-- #            :price floats
-- #            :time int
INSERT OR REPLACE INTO Auction(Player, Item, Price, Time) VALUES (:player, :item, :price, :time);
-- #        }
-- #        { bid
-- #            :player string
-- #            :price float
-- #            :id int
INSERT OR REPLACE INTO Bid(Player, Price, Id) VALUES (:player, :price, :id);
-- #        }
-- #    }
-- #    { update
-- #        { auction
-- #            { expired
-- #                :id int
-- #                :expired bool
UPDATE Auction SET Expired = :expired WHERE Id = :id;
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
-- #        { auction
-- #            { id
-- #                :id int
SELECT * FROM Auction WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT * FROM Auction WHERE Player = :player;
-- #            }
-- #            { all
SELECT * FROM Auction;
-- #            }
-- #            { all.no-expired
SELECT * FROM Auction WHERE Expired = FALSE;
-- #            }
-- #            { all.expired
SELECT * FROM Auction WHERE Expired = TRUE;
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