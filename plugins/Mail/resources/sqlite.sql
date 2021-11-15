-- #! sqlite
-- #{ mail
-- #    { init
CREATE TABLE IF NOT EXISTS Mail
(
    Id              INTEGER PRIMARY KEY AUTOINCREMENT UNIQUE,
    FromName        VARCHAR NOT NULL,
    ToName          VARCHAR NOT NULL,
    Title           TEXT    NOT NULL,
    Msg             TEXT,
    Items           BLOB,
    Time            INTEGER,
    IsRead          BOOLEAN NOT NULL DEFAULT FALSE,
    IsClaimed       BOOLEAN NOT NULL DEFAULT FALSE,
    IsDeletedByFrom BOOLEAN NOT NULL DEFAULT FALSE,
    IsDeletedByTo   BOOLEAN NOT NULL DEFAULT FALSE
);
-- #    }
-- #    { register
-- #        :from string
-- #        :to string
-- #        :title string
-- #        :msg string
-- #        :items string
-- #        :time int
INSERT OR
REPLACE
INTO Mail (FromName,
           ToName,
           Title,
           Msg,
           Items,
           Time)
VALUES (:from,
        :to,
        :title,
        :msg,
        :items,
        :time);
-- #    }
-- #    { remove
-- #        :id int
DELETE
FROM Mail
WHERE Id = :id;
-- #    }
-- #    { select
-- #        { all
SELECT *
FROM Mail;
-- #        }
-- #        { from
-- #            :name string
SELECT *
FROM Mail
WHERE (FromName = :name)
  AND (IsDeletedByFrom = FALSE);
-- #        }
-- #        { to
-- #            :name string
SELECT *
FROM Mail
WHERE (ToName = :name)
  AND (IsDeletedByTo = FALSE);
-- #        }
-- #        { id
-- #            :id int
SELECT *
FROM Mail
WHERE Id = :id;
-- #        }
-- #        { unread
-- #            :name string
SELECT *
FROM Mail
WHERE (ToName = :name)
  AND (IsRead = FALSE);
-- #        }
-- #    }
-- #    { update
-- #        { isread
-- #            :id int
-- #            :isread bool
UPDATE Mail
SET IsRead = :isread
WHERE Id = :id;
-- #        }
-- #        { isclaimed
-- #            :id int
-- #            :isclaimed bool
UPDATE Mail
SET IsClaimed = :isclaimed
WHERE Id = :id;
-- #        }
-- #        { isdeletedbyfrom
-- #            :id int
-- #            :isdeletedbyfrom bool
UPDATE Mail
SET IsDeletedByFrom = :isdeletedbyfrom
WHERE Id = :id;
-- #        }
-- #        { isdeletedbyto
-- #            :id int
-- #            :isdeletedbyto bool
UPDATE Mail
SET IsDeletedByTo = :isdeletedbyto
WHERE Id = :id;
-- #        }
-- #    }
-- #}