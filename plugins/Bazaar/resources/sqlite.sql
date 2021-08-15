-- #! sqlite
-- #{ bazaar
-- #    { init
-- #        { buy
CREATE TABLE IF NOT EXISTS BuyOrder (
    Id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE ,
    Player VARCHAR(40) NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Amount INTEGER NOT NULL DEFAULT 0,
    Filled INTEGER NOT NULL DEFAULT 0,
    ItemID INTEGER NOT NULL DEFAULT 0,
    Time INTEGER NOT NULL DEFAULT 0
);
-- #        }
-- #        { sell
CREATE TABLE IF NOT EXISTS SellOrder (
    Id INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    Player VARCHAR(40) NOT NULL,
    Price FLOAT NOT NULL DEFAULT 0,
    Amount INTEGER NOT NULL DEFAULT 0,
    Filled INTEGER NOT NULL DEFAULT 0,
    ItemID INTEGER NOT NULL DEFAULT 0,
    Time INTEGER NOT NULL DEFAULT 0
);
-- #        }
-- #    }
-- #    { register
-- #        { buy
-- #            :player string
-- #            :price float
-- #            :amount int
-- #            :filled int
-- #            :itemID int
-- #            :time int
INSERT OR REPLACE INTO BuyOrder (
    Player,
    Price,
    Amount,
    Filled,
    ItemID,
    Time
) VALUES (
    :player,
    :price,
    :amount,
    :filled,
    :itemID,
    :time
);
-- #        }
-- #        { sell
-- #            :player string
-- #            :price float
-- #            :amount int
-- #            :filled int
-- #            :itemID int
-- #            :time int
INSERT OR REPLACE INTO SellOrder (
    Player,
    Price,
    Amount,
    Filled,
    ItemID,
    Time
) VALUES (
    :player,
    :price,
    :amount,
    :filled,
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
-- #    { select
-- #        { buy
-- #            { id
-- #                :id int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM BuyOrder WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM BuyOrder WHERE Player = :player;
-- #            }
-- #            { itemid
-- #                { unsort
-- #                    :itemid int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM BuyOrder WHERE ItemID = :itemid;
-- #                }
-- #                { sort
-- #                    { price
-- #                        :itemid int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM BuyOrder WHERE ItemID = :itemid ORDER BY Price DESC;
-- #                    }
-- #                }
-- #            }
-- #        }
-- #        { sell
-- #            { id
-- #                :id int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM SellOrder WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM SellOrder WHERE Player = :player;
-- #            }
-- #            { itemid
-- #                { unsort
-- #                    :itemid int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM SellOrder WHERE ItemID = :itemid;
-- #                }
-- #                { sort
-- #                    { price
-- #                        :itemid int
SELECT Id, Player, Price, Amount, Filled, ItemID, Time FROM SellOrder WHERE ItemID = :itemid ORDER BY Price;
-- #                    }
-- #                }
-- #            }
-- #        }
-- #    }
-- #    { update
-- #        { buy
-- #            { filled
-- #                :id int
-- #                :filled int
UPDATE BuyOrder SET Filled = :filled WHERE Id = :id;
-- #            }
-- #        }
-- #        { sell
-- #            { filled
-- #                :id int
-- #                :filled int
UPDATE SellOrder SET Filled = :filled WHERE Id = :id;
-- #            }
-- #        }
-- #    }
-- #}