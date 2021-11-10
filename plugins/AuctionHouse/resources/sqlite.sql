-- #! sqlite
-- #{ auction
-- #    { init
-- #        { auction
CREATE TABLE IF NOT EXISTS Auction(
    Id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    AuctionType INTEGER NOT NULL DEFAULT 0,
    Player VARCHAR(40) NOT NULL,
    Item BLOB NOT NULL,
    Category TEXT NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Time INTEGER NOT NULL DEFAULT 0,
    AuctionTime INTEGER NOT NULL DEFAULT 0,
    Expired BOOLEAN NOT NULL DEFAULT FALSE,
    HaveBid BOOLEAN NOT NULL DEFAULT FALSE
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
-- #            :auctiontype int
-- #            :player string
-- #            :item string
-- #            :category string
-- #            :price floats
-- #            :time int
-- #            :auctiontime int
INSERT OR REPLACE INTO Auction(AuctionType, Player, Item, Category, Price, Time, AuctionTime)
VALUES (:auctiontype, :player, :item, :category, :price, :time, :auctiontime);
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
-- #            { havebid
-- #                :id int
-- #                :havebid bool
UPDATE Auction SET HaveBid = :havebid WHERE Id = :id;
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
SELECT * FROM Auction WHERE (Expired = TRUE) AND (Category = :category) AND (HaveBid = FALSE);
-- #            }
-- #            { type
-- #                :type int
SELECT * FROM Auction WHERE (Expired = FALSE) AND (AuctionType = :type);
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
-- #            { pandi
-- #                :player string
-- #                :id int
SELECT * FROM Bid WHERE Player = :player AND Id = :id;
-- #            }
-- #        }
-- #    }
-- #}