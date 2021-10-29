-- #! sqlite
-- #{ backpack
-- #    { init
CREATE TABLE IF NOT EXISTS Backpack
(
    Player VARCHAR(40) NOT NULL,
    Slot   INTEGER     NOT NULL,
    Data   BLOB        NOT NULL
);
-- #    }
-- #    { register
-- #        :player string
-- #        :slot int
-- #        :data string
INSERT OR
REPLACE
INTO Backpack(Player, Slot, Data)
VALUES (:player, :slot, :data);
-- #    }
-- #    { remove
-- #        { all
-- #            :player string
DELETE
FROM Backpack
WHERE Player = :player;
-- #        }
-- #        { slot
-- #            :player string
-- #            :slot int
DELETE
FROM Backpack
WHERE Player = :player
  AND Slot = :slot;
-- #        }
-- #    }
-- #    { update
-- #        :player string
-- #        :slot int
-- #        :data string
UPDATE Backpack
SET Data = :data
WHERE Player = :player
  AND Slot = :slot;
-- #    }
-- #    { select
-- #        { all
SELECT * FROM Backpack;
-- #        }
-- #        { player
-- #            :player string
SELECT * FROM Backpack WHERE Player = :player;
-- #        }
-- #        { slot
-- #            :player string
-- #            :slot int
SELECT * FROM Backpack WHERE Player = :player AND Slot = :slot;
-- #        }
-- #    }
-- #}