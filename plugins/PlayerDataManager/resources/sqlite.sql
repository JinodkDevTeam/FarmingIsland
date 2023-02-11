-- #!sqlite
-- #{ pdm
-- #    { init
-- #        { players
CREATE TABLE IF NOT EXISTS Players
(
    Xuid             VARCHAR NOT NULL PRIMARY KEY,
    Gametag          VARCHAR NOT NULL UNIQUE,
    CurrentProfileID INTEGER NOT NULL DEFAULT -1,
    CONSTRAINT CurrentProfileID FOREIGN KEY (CurrentProfileID) REFERENCES Profiles (ProfileID)
);
-- #        }
-- #        { profiles
CREATE TABLE IF NOT EXISTS Profiles
(
    ProfileID   INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    ProfileName VARCHAR                           NOT NULL DEFAULT '',
    Xuid        VARCHAR                           NOT NULL UNIQUE,
    SaveKey     VARCHAR                           NOT NULL UNIQUE,
    CONSTRAINT Xuid FOREIGN KEY (Xuid) REFERENCES Players (Xuid)
);
-- #        }
-- #    }
-- #    { register
-- #        { player
-- #            :xuid string
-- #            :gametag string
INSERT OR
REPLACE
INTO Players(Xuid, Gametag)
VALUES (:xuid, :gametag);
-- #        }
-- #        { profile
-- #            :profile_name string
-- #            :xuid string
-- #            :savekey string
INSERT OR
REPLACE
INTO Profiles(ProfileName, Xuid, SaveKey)
VALUES (:profile_name, :xuid, :savekey);
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
-- #                :profile_id int
DELETE
FROM Profiles
WHERE ProfileID = :profile_id;
-- #            }
-- #            { xuid
-- #                :xuid string
DELETE
FROM Profiles
WHERE Xuid = :xuid;
-- #            }
-- #            { savekey
-- #                :savekey string
DELETE
FROM Profiles
WHERE SaveKey = :savekey;
-- #            }
-- #            { gametag
-- #                :gametag string
DELETE
FROM Profiles
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
SET CurrentProfileID = :profile_id
WHERE Xuid = :xuid;
-- #        }
-- #        { profile_name
-- #            :profile_id int
-- #            :profile_name string
UPDATE Profiles
SET ProfileName = :profile_name
WHERE ProfileID = :profile_id;
-- #        }
-- #        { profile_xuid
-- #            :profile_id int
-- #            :xuid string
UPDATE Profiles
SET Xuid = :xuid
WHERE ProfileID = :profile_id;
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
-- #            { xuid
-- #                :xuid string
SELECT *
FROM Profiles
WHERE Xuid = :xuid;
-- #            }
-- #            { savekey
-- #                :savekey string
SELECT *
FROM Profiles
WHERE SaveKey = :savekey;
-- #            }
-- #            { gametag
-- #                :gametag string
SELECT *
FROM Profiles
WHERE Xuid IN (SELECT Xuid
               FROM Players
               WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #        { current_profile
-- #            { xuid
-- #                :xuid string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT CurrentProfileID
                    FROM Players
                    WHERE Xuid = :xuid);
-- #            }
-- #            { gametag
-- #                :gametag string
SELECT *
FROM Profiles
WHERE ProfileID IN (SELECT CurrentProfileID
                    FROM Players
                    WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #    }
-- #}