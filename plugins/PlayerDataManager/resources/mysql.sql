-- #!mysql
-- #{ pdm
-- #    { init
-- #        { players
CREATE TABLE IF NOT EXISTS PDM_Players
(
    Xuid    TEXT NOT NULL PRIMARY KEY,
    Gametag TEXT NOT NULL UNIQUE,
    CurrentProfileID INTEGER NOT NULL DEFAULT -1,
    CONSTRAINT CurrentProfileID FOREIGN KEY (CurrentProfileID) REFERENCES PDM_Profiles (ProfileID)
);
-- #        }
-- #        { profiles
CREATE TABLE IF NOT EXISTS PDM_Profiles
(
    ProfileID   INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    ProfileName TEXT                               NOT NULL DEFAULT '',
    Xuid        TEXT                               NOT NULL UNIQUE,
    SaveKey     TEXT                               NOT NULL UNIQUE,
    CONSTRAINT Xuid FOREIGN KEY (Xuid) REFERENCES PDM_Players (Xuid)
);
-- #        }
-- #    }
-- #    { register
-- #        { player
-- #            :xuid string
-- #            :gametag string
INSERT
INTO PDM_Players(Xuid, Gametag)
VALUES (:xuid, :gametag)
ON DUPLICATE KEY UPDATE Gametag = :gametag;
-- #        }
-- #        { profile
-- #            :profile_name string
-- #            :xuid string
-- #            :savekey string
INSERT
INTO PDM_Profiles(ProfileName, Xuid, SaveKey)
VALUES (:profile_name, :xuid, :save_key)
ON DUPLICATE KEY UPDATE ProfileName = :profile_name,
                        SaveKey     = :savekey;
-- #        }
-- #    }
-- #    { remove
-- #        { player
-- #            { gametag
-- #                :gametag string
DELETE
FROM PDM_Players
WHERE Gametag = :gametag;
-- #            }
-- #            { xuid
-- #                :xuid string
DELETE
FROM PDM_Players
WHERE Xuid = :xuid;
-- #            }
-- #        }
-- #        { profile
-- #            { id
-- #                :profile_id int
DELETE
FROM PDM_Profiles
WHERE ProfileID = :profile_id;
-- #            }
-- #            { xuid
-- #                :xuid string
DELETE
FROM PDM_Profiles
WHERE Xuid = :xuid;
-- #            }
-- #            { savekey
-- #                :savekey string
DELETE
FROM PDM_Profiles
WHERE SaveKey = :savekey;
-- #            }
-- #            { gametag
-- #                :gametag string
DELETE
FROM PDM_Profiles
WHERE Xuid IN (SELECT Xuid
               FROM PDM_Players
               WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #    }
-- #    { update
-- #        { gametag
-- #            :xuid string
-- #            :gametag string
UPDATE PDM_Players
SET Gametag = :gametag
WHERE Xuid = :xuid;
-- #        }
-- #        { current_profile
-- #            :profile_id int
-- #            :xuid string
UPDATE PDM_Players
SET CurrentProfileID = :profile_id
WHERE Xuid = :xuid;
-- #        }
-- #        { profile_name
-- #            :profile_id int
-- #            :profile_name string
UPDATE PDM_Profiles
SET ProfileName = :profile_name
WHERE ProfileID = :profile_id;
-- #        }
-- #        { profile_xuid
-- #            :profile_id int
-- #            :xuid string
UPDATE PDM_Profiles
SET Xuid = :xuid
WHERE ProfileID = :profile_id;
-- #        }
-- #    }
-- #    { select
-- #        { player
-- #            { gametag
-- #                :gametag string
SELECT *
FROM PDM_Players
WHERE Gametag = :gametag;
-- #            }
-- #            { xuid
-- #                :xuid string
SELECT *
FROM PDM_Players
WHERE Xuid = :xuid;
-- #            }
-- #            { prefix
-- #                :prefix string
SELECT *
FROM PDM_Players
WHERE Gametag LIKE :prefix || '%';
-- #            }
-- #        }
-- #        }
-- #        { profile
-- #            { id
-- #                :profile_id int
SELECT *
FROM PDM_Profiles
WHERE ProfileID = :profile_id;
-- #            }
-- #            { xuid
-- #                :xuid string
SELECT *
FROM PDM_Profiles
WHERE Xuid = :xuid;
-- #            }
-- #            { savekey
-- #                :savekey string
SELECT *
FROM PDM_Profiles
WHERE SaveKey = :savekey;
-- #            }
-- #            { gametag
-- #                :gametag string
SELECT *
FROM PDM_Profiles
WHERE Xuid IN (SELECT Xuid
               FROM PDM_Players
               WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #        { current_profile
-- #            { xuid
-- #                :xuid string
SELECT *
FROM PDM_Profiles
WHERE ProfileID IN (SELECT CurrentProfileID
                    FROM PDM_Players
                    WHERE Xuid = :xuid);
-- #            }
-- #            { gametag
-- #                :gametag string
SELECT *
FROM PDM_Profiles
WHERE ProfileID IN (SELECT CurrentProfileID
                    FROM PDM_Players
                    WHERE Gametag = :gametag);
-- #            }
-- #        }
-- #    }
-- #}