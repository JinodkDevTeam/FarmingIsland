-- #! sqlite

-- #{ fai
-- #    { init
CREATE TABLE IF NOT EXISTS FAI
(
    Player VARCHAR(50) NOT NULL,
    X      INTEGER     NOT NULL DEFAULT 0,
    Z      INTEGER     NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #        :player string
-- #        :x int
-- #        :z int
INSERT OR
REPLACE INTO FAI
(Player,
 X,
 Z)
VALUES (:player,
        :x,
        :z);
-- #    }
-- #    { select
-- #        { player
-- #            :player string
SELECT *
FROM FAI
WHERE Player = :player;
-- #        }
-- #        { id
-- #            :x int
-- #            :z int
SELECT *
FROM FAI
WHERE (X = :x)
  AND (Z = :z);
-- #        }
-- #    }
-- #    { remove
-- #        :player string
-- #        :x int
-- #        :z int
DELETE
FROM FAI
WHERE (Player = :player)
  AND (X = :x)
  AND (Z = :z);
-- #    }
-- #}