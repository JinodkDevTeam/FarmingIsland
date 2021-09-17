-- #! sqlite
-- #{ bazaar
-- #    { init
-- #        { buy
CREATE TABLE IF NOT EXISTS BuyOrder
(
    Id       INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    Player   VARCHAR(40) NOT NULL,
    Price    FLOAT       NOT NULL DEFAULT 0,
    Amount   INTEGER     NOT NULL DEFAULT 0,
    Filled   INTEGER     NOT NULL DEFAULT 0,
    ItemID   INTEGER     NOT NULL DEFAULT 0,
    Time     INTEGER     NOT NULL DEFAULT 0,
    IsFilled BOOLEAN     NOT NULL DEFAULT false
);
-- #        }
-- #        { sell
CREATE TABLE IF NOT EXISTS SellOrder
(
    Id       INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    Player   VARCHAR(40) NOT NULL,
    Price    FLOAT       NOT NULL DEFAULT 0,
    Amount   INTEGER     NOT NULL DEFAULT 0,
    Filled   INTEGER     NOT NULL DEFAULT 0,
    ItemID   INTEGER     NOT NULL DEFAULT 0,
    Time     INTEGER     NOT NULL DEFAULT 0,
    IsFilled BOOLEAN     NOT NULL DEFAULT false
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
-- #            :isfilled bool
INSERT OR
REPLACE INTO BuyOrder (Player,
                       Price,
                       Amount,
                       Filled,
                       ItemID,
                       Time,
                       IsFilled)
VALUES (:player,
        :price,
        :amount,
        :filled,
        :itemID,
        :time,
        :isfilled);
-- #        }
-- #        { sell
-- #            :player string
-- #            :price float
-- #            :amount int
-- #            :filled int
-- #            :itemID int
-- #            :time int
-- #            :isfilled bool
INSERT OR
REPLACE INTO SellOrder (Player,
                        Price,
                        Amount,
                        Filled,
                        ItemID,
                        Time,
                        IsFilled)
VALUES (:player,
        :price,
        :amount,
        :filled,
        :itemID,
        :time,
        :isfilled);
-- #        }
-- #    }
-- #    { remove
-- #        { buy
-- #            :id int
DELETE
FROM BuyOrder
WHERE Id = :id;
-- #        }
-- #        { sell
-- #            :id int
DELETE
FROM SellOrder
WHERE Id = :id;
-- #        }
-- #    }
-- #    { select
-- #        { buy
-- #            { id
-- #                :id int
SELECT *
FROM BuyOrder
WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT *
FROM BuyOrder
WHERE Player = :player;
-- #            }
-- #            { itemid
-- #                { unsort
-- #                    :itemid int
SELECT *
FROM BuyOrder
WHERE ItemID = :itemid;
-- #                }
-- #                { sort
-- #                    { price
-- #                        :itemid int
SELECT *
FROM BuyOrder
WHERE (ItemID = :itemid)
  AND (IsFilled = false)
ORDER BY Price DESC;
-- #                    }
-- #                }
-- #            }
-- #        }
-- #        { sell
-- #            { id
-- #                :id int
SELECT *
FROM SellOrder
WHERE Id = :id;
-- #            }
-- #            { player
-- #                :player string
SELECT *
FROM SellOrder
WHERE Player = :player;
-- #            }
-- #            { itemid
-- #                { unsort
-- #                    :itemid int
SELECT *
FROM SellOrder
WHERE ItemID = :itemid;
-- #                }
-- #                { sort
-- #                    { price
-- #                        :itemid int
SELECT *
FROM SellOrder
WHERE (ItemID = :itemid)
  AND (IsFilled = false)
ORDER BY Price;
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
UPDATE BuyOrder
SET Filled = :filled
WHERE Id = :id;
-- #            }
-- #            { isfilled
-- #                :id int
-- #                :isfilled bool
UPDATE BuyOrder
SET IsFilled = :isfilled
WHERE Id = :id;
-- #            }
-- #        }
-- #        { sell
-- #            { filled
-- #                :id int
-- #                :filled int
UPDATE SellOrder
SET Filled = :filled
WHERE Id = :id;
-- #            }
-- #            { isfilled
-- #                :id int
-- #                :isfilled bool
UPDATE SellOrder
SET IsFilled = :isfilled
WHERE Id = :id;
-- #            }
-- #        }
-- #    }
-- #}