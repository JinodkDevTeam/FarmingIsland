-- #! sqlite
-- #{ bank
-- #    { init
CREATE TABLE IF NOT EXISTS Bank
(
    Player VARCHAR(40) NOT NULL,
    Money  FLOAT       NOT NULL DEFAULT 0,
    Upgrade INTEGER    NOT NULL DEFAULT 1
);
-- #    }
-- #    { register
-- #        :player string
-- #        :value float
-- #        :upgrade int
INSERT OR
REPLACE
INTO Bank (Player, Money, Upgrade)
VALUES (:player, :value, :upgrade);
-- #    }
-- #    { get
-- #        :player string
SELECT *
FROM Bank
WHERE Player = :player;
-- #    }
-- #    { getall
SELECT *
FROM Bank;
-- #    }
-- #    { remove
-- #        :player string
DELETE
FROM Bank
WHERE Player = :player;
-- #    }
-- #    { update
-- #        { balance
-- #            :player string
-- #            :value float
UPDATE Bank
SET Money = :value
WHERE Player = :player;
-- #        }
-- #        { upgrade
-- #            :player string
-- #            :value int
UPDATE Bank
SET Upgrade = :value
WHERE Player = :player;
-- #        }
-- #    }
-- #    { top
SELECT *
FROM Bank
ORDER BY Money;
-- #    }
-- #}