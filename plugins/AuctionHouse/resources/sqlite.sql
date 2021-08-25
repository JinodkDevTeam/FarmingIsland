-- #! sqlite
-- #{ auction
-- #    { init
-- #        { auction
CREATE TABLE IF NOT EXISTS Auction(
    Id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    Player VARCHAR(40) NOT NULL,
    Item BLOB NOT NULL,
    Category TEXT NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Time INTEGER NOT NULL DEFAULT 0,
    AuctionTime INTEGER NOT NULL DEFAULT 0,
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
-- #            :category string
-- #            :price floats
-- #            :time int
-- #            :auctiontime
INSERT OR REPLACE INTO Auction(Player, Item, Category, Price, Time, AuctionTime) VALUES (:player, :item, :category, :price, :time, :auctiontime);
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
-- #                :category string
SELECT * FROM Auction WHERE Category = :category;
-- #            }
-- #            { all.no-expired
-- #                :category string
SELECT * FROM Auction WHERE Expired = FALSE AND Category = :category;
-- #            }
-- #            { all.expired
-- #                :category string
SELECT * FROM Auction WHERE Expired = TRUE AND Category = :category;
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