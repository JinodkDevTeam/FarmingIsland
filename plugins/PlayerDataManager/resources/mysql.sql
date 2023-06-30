-- #!sqlite
-- #{ pdm
-- #    { init
-- #        { players
CREATE TABLE IF NOT EXISTS Players
(
    Xuid             TEXT NOT NULL PRIMARY KEY, -- UUID
    Gametag          TEXT NOT NULL UNIQUE,
    DefaultProfileID TEXT NOT NULL DEFAULT -1,
    CONSTRAINT CurrentProfileID FOREIGN KEY (DefaultProfileID) REFERENCES Profiles (ProfileID)
);
-- #        }
-- #        { profiles
CREATE TABLE IF NOT EXISTS Profiles
(
    ProfileID   TEXT PRIMARY KEY NOT NULL, -- UUID
    ProfileName TEXT             NOT NULL DEFAULT '',
    ProfileType INTEGER             NOT NULL DEFAULT 0
);
-- #        }
-- #        { profile_player
CREATE TABLE IF NOT EXISTS ProfilePlayer
(
    ProfilePlayerID TEXT PRIMARY KEY NOT NULL, -- UUID
    Xuid            TEXT             NOT NULL,
    ProfileID       TEXT             NOT NULL,
    Inventory       BLOB                NOT NULL DEFAULT '',
    CONSTRAINT ProfilePlayerXuid FOREIGN KEY (Xuid) REFERENCES Players (Xuid),
    CONSTRAINT ProfilePlayerProfileID FOREIGN KEY (ProfileID) REFERENCES Profiles (ProfileID)
);
-- #        }
-- #    }
-- #    { register
-- #        { player
-- #            :xuid string
-- #            :gametag string
INSERT
INTO Players(Xuid, Gametag)
VALUES (:xuid, :gametag)
ON DUPLICATE KEY UPDATE Gametag = :gametag;
-- #        }
-- #        { profile
-- #            :profile_id string
-- #            :profile_name string
-- #            :profile_type string
INSERT
INTO Profiles(ProfileID, ProfileName, ProfileType)
VALUES (:profile_id, :profile_name, :profile_type)
ON DUPLICATE KEY UPDATE ProfileName = :profile_name, ProfileType = :profile_type;
-- #        }
-- #        { profile_player
-- #            :profile_player_id string
-- #            :xuid string
-- #            :profile_id string
INSERT
INTO ProfilePlayer(ProfilePlayerID, Xuid, ProfileID)
VALUES (:profile_player_id, :xuid, :profile_id)
ON DUPLICATE KEY UPDATE Xuid = :xuid, ProfileID = :profile_id;
-- #        }
-- #    }
-- #    { remove
-- #        { player
-- #            { gametag
-- #                :gametag string
DELETE
FROM Players
WHERE Gametag = :gametag;
-- #            }
-- #            { xuid
-- #                :xuid string
DELETE
FROM Players
WHERE Xuid = :xuid;
-- #            }
-- #        }
-- #        { profile
-- #            { id
-- #                :profile_id string
DELETE
FROM Profiles
WHERE ProfileID = :profile_id;
-- #            }
-- #        }
-- #        { profile_player
-- #            { id
-- #                :profile_player_id string
DELETE
FROM ProfilePlayer
WHERE ProfilePlayerID = :profile_player_id;
-- #            }
-- #            { xuid
-- #                :xuid string
DELETE
FROM ProfilePlayer
WHERE Xuid = :xuid;
-- #            }
-- #            { profile_id
-- #                :profile_id string
DELETE
FROM ProfilePlayer
WHERE ProfileID = :profile_id;
-- #            }
-- #            { gametag
-- #                :gametag string
DELETE
FROM ProfilePlayer
WHERE Xuid IN (SELECT Xuid
               FROM Players
               WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #    }
-- #    { update
-- #        { gametag
-- #            :xuid string
-- #            :gametag string
UPDATE Players
SET Gametag = :gametag
WHERE Xuid = :xuid;
-- #        }
-- #        { current_profile
-- #            :profile_id int
-- #            :xuid string
UPDATE Players
SET DefaultProfileID = :profile_id
WHERE Xuid = :xuid;
-- #        }
-- #        { profile_name
-- #            :profile_id int
-- #            :profile_name string
UPDATE Profiles
SET ProfileName = :profile_name
WHERE ProfileID = :profile_id;
-- #        }
-- #        { profile_type
-- #            :profile_id int
-- #            :profile_type int
UPDATE Profiles
SET ProfileType = :profile_type
WHERE ProfileID = :profile_id;
-- #        }
-- #        { profile_player_xuid
-- #            :profile_player_id int
-- #            :xuid string
UPDATE ProfilePlayer
SET Xuid = :xuid
WHERE ProfilePlayerID = :profile_player_id;
-- #        }
-- #        { profile_player_profile_id
-- #            :profile_player_id int
-- #            :profile_id int
UPDATE ProfilePlayer
SET ProfileID = :profile_id
WHERE ProfilePlayerID = :profile_player_id;
-- #        }
-- #        { profile_player_inventory
-- #            :profile_player_id int
-- #            :inventory string
UPDATE ProfilePlayer
SET Inventory = :inventory
WHERE ProfilePlayerID = :profile_player_id;
-- #        }
-- #    }
-- #    { select
-- #        { player
-- #            { gametag
-- #                :gametag string
SELECT *
FROM Players
WHERE Gametag = :gametag;
-- #            }
-- #            { xuid
-- #                :xuid string
SELECT *
FROM Players
WHERE Xuid = :xuid;
-- #            }
-- #            { prefix
-- #                :prefix string
SELECT *
FROM Players
WHERE Gametag LIKE :prefix || '%';
-- #            }
-- #        }
-- #        { profile
-- #            { id
-- #                :profile_id int
SELECT *
FROM Profiles
WHERE ProfileID = :profile_id;
-- #            }
-- #        }
-- #        { profile_name
-- #            :profile_name string
SELECT *
FROM Profiles
WHERE ProfileName = :profile_name;
-- #        }
-- #        { profile_type
-- #            :profile_type int
SELECT *
FROM Profiles
WHERE ProfileType = :profile_type;
-- #        }
-- #        { profile_xuid
-- #            :xuid string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT ProfileID
                    FROM ProfilePlayer
                    WHERE Xuid = :xuid);
-- #        }
-- #        { profile_gametag
-- #            :gametag string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT ProfileID
                    FROM ProfilePlayer
                    WHERE Xuid IN (SELECT Xuid
                                   FROM Players
                                   WHERE Gametag = :gametag));
-- #        }
-- #        { profile_profileplayer
-- #            :profile_player_id string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT ProfileID
                    FROM ProfilePlayer
                    WHERE ProfilePlayerID = :profile_player_id);
-- #        }
-- #        { current_profile
-- #            { xuid
-- #                :xuid string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT DefaultProfileID
                    FROM Players
                    WHERE Xuid = :xuid);
-- #            }
-- #            { gametag
-- #                :gametag string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT DefaultProfileID
                    FROM Players
                    WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #    }
-- #}