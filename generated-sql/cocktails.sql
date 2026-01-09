
-----------------------------------------------------------------------
-- cocktails
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [cocktails];

CREATE TABLE [cocktails]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [name] VARCHAR(255) NOT NULL,
    [description] MEDIUMTEXT NOT NULL,
    UNIQUE ([id])
);

-----------------------------------------------------------------------
-- ingredients
-----------------------------------------------------------------------

DROP TABLE IF EXISTS [ingredients];

CREATE TABLE [ingredients]
(
    [id] INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    [name] VARCHAR(255) NOT NULL,
    [description] MEDIUMTEXT NOT NULL,
    UNIQUE ([id])
);
