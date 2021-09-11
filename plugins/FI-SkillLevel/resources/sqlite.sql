-- #! sqlite

-- #{ skill
-- #    { init
CREATE TABLE IF NOT EXISTS Skill
(
    Player        VARCHAR(40)  NOT NULL,
    MiningLevel   INT UNSIGNED NOT NULL DEFAULT 1,
    MiningExp     INT UNSIGNED NOT NULL DEFAULT 0,
    FishingLevel  INT UNSIGNED NOT NULL DEFAULT 1,
    FishingExp    INT UNSIGNED NOT NULL DEFAULT 0,
    FarmingLevel  INT UNSIGNED NOT NULL DEFAULT 1,
    FarmingExp    INT UNSIGNED NOT NULL DEFAULT 0,
    ForagingLevel INT UNSIGNED NOT NULL DEFAULT 1,
    ForagingExp   INT UNSIGNED NOT NULL DEFAULT 0
);
-- #    }
-- #    { loadplayer
-- #        :player string
SELECT MiningLevel,
       MiningExp,
       FishingLevel,
       FishingExp,
       FarmingLevel,
       FarmingExp,
       ForagingLevel,
       ForagingExp
FROM Skill
WHERE Player = :player;
-- #    }
-- #    { register
-- #        :player string
-- #        :mininglevel int
-- #        :miningexp int
-- #        :fishinglevel int
-- #        :fishingexp int
-- #        :farminglevel int
-- #        :farmingexp int
-- #        :foraginglevel int
-- #        :foragingexp int
INSERT OR
REPLACE INTO Skill
(Player,
 MiningLevel,
 MiningExp,
 FishingLevel,
 FishingExp,
 FarmingLevel,
 FarmingExp,
 ForagingLevel,
 ForagingExp)
VALUES (:player,
        :mininglevel,
        :miningexp,
        :fishinglevel,
        :fishingexp,
        :farminglevel,
        :farmingexp,
        :foraginglevel,
        :foragingexp);
-- #    }
-- #    { unregister
-- #        :player string
DELETE
FROM Skill
WHERE Player = :player;
-- #    }
-- #    { update
-- #        { mining
-- #            { level
-- #                :player string
-- #                :level int
UPDATE Skill
SET MiningLevel=:level
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
-- #                :exp int
UPDATE Skill
SET MiningExp=:exp
WHERE Player = :player;
-- #            }
-- #        }
-- #        { fishing
-- #            { level
-- #                :player string
-- #                :level int
UPDATE Skill
SET FishingLevel=:level
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
-- #                :exp int
UPDATE Skill
SET FishingExp=:exp
WHERE Player = :player;
-- #            }
-- #        }
-- #        { farming
-- #            { level
-- #                :player string
-- #                :level int
UPDATE Skill
SET FarmingLevel=:level
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
-- #                :exp int
UPDATE Skill
SET FarmingExp=:exp
WHERE Player = :player;
-- #            }
-- #        }
-- #        { foraging
-- #            { level
-- #                :player string
-- #                :level int
UPDATE Skill
SET ForagingLevel=:level
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
-- #                :exp int
UPDATE Skill
SET ForagingExp=:exp
WHERE Player = :player;
-- #            }
-- #        }
-- #    }
-- #    { get
-- #        { mining
-- #            { level
-- #                :player string
SELECT MiningLevel
FROM Skill
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
SELECT MiningExp
FROM Skill
WHERE Player = :player;
-- #            }
-- #        }
-- #        { fishing
-- #            { level
-- #                :player string
SELECT FishingLevel
FROM Skill
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
SELECT FishingExp
FROM Skill
WHERE Player = :player;
-- #            }
-- #        }
-- #        { farming
-- #            { level
-- #                :player string
SELECT FarmingLevel
FROM Skill
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
SELECT FarmingExp
FROM Skill
WHERE Player = :player;
-- #            }
-- #        }
-- #        { foraging
-- #            { level
-- #                :player string
SELECT ForagingLevel
FROM Skill
WHERE Player = :player;
-- #            }
-- #            { exp
-- #                :player string
SELECT ForagingExp
FROM Skill
WHERE Player = :player;
-- #            }
-- #        }
-- #    }
-- #}