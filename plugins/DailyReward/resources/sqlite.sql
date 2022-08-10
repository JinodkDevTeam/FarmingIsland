-- #! sqlite
-- # { dailyreward
-- #    { init
CREATE TABLE IF NOT EXISTS DailyReward
(
    Player    VARCHAR(40) NOT NULL,
    Streak    INTEGER     NOT NULL DEFAULT 0,
    ClaimTime INTEGER     NOT NULL DEFAULT 0
);
-- #    }
-- #    { register
-- #        :player string
-- #        :streak int
-- #        :claimtime int
INSERT OR
REPLACE
INTO DailyReward(Player, Streak, ClaimTime)
VALUES (:player,
        :streak,
        :claimtime);
-- #    }
-- #    { update
-- #        :player string
-- #        :streak int
-- #        :claimtime int
UPDATE DailyReward
SET Streak    = :streak,
    ClaimTime = :claimtime
WHERE Player = :player;
-- #    }
-- #    { select
-- #        :player string
SELECT * FROM DailyReward WHERE Player = :player;
-- #    }
-- #    { remove
-- #        :player string
DELETE FROM DailyReward WHERE Player = :player;
-- #    }
-- # }