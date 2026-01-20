<?php
use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1768924516.
 * Generated on 2026-01-20 15:55:16 by amadare */
class PropelMigration_1768924516{
    /**
     * @var string
     */
    public $comment = '';

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    /**
     * @param \Propel\Generator\Manager\MigrationManager $manager
     *
     * @return null|false|void
     */
    public function postDown(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL(): array
    {
        $connection_cocktails = <<< 'EOT'

PRAGMA foreign_keys = OFF;

CREATE TEMPORARY TABLE [recipe__temp__696fa5649c60c] AS SELECT [cocktail_id],[ingredient_id],[amount],[measure] FROM [recipe];
DROP TABLE [recipe];

CREATE TABLE [recipe]
(
    [cocktail_id] INTEGER NOT NULL,
    [ingredient_id] INTEGER NOT NULL,
    [amount] INTEGER NOT NULL,
    [measure] VARCHAR(255) NOT NULL,
    [variation] INTEGER NOT NULL,
    PRIMARY KEY ([cocktail_id],[ingredient_id]),
    UNIQUE ([cocktail_id],[ingredient_id]),
    FOREIGN KEY ([cocktail_id]) REFERENCES [cocktails] ([id])
        ON DELETE CASCADE,
    FOREIGN KEY ([ingredient_id]) REFERENCES [ingredients] ([id])
        ON DELETE CASCADE
);

INSERT INTO [recipe] (measure, cocktail_id, ingredient_id, amount) SELECT measure, cocktail_id, ingredient_id, amount FROM [recipe__temp__696fa5649c60c];
DROP TABLE [recipe__temp__696fa5649c60c];

PRAGMA foreign_keys = ON;
EOT;

        return [
            'cocktails' => $connection_cocktails,
        ];
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL(): array
    {
        $connection_cocktails = <<< 'EOT'

PRAGMA foreign_keys = OFF;

CREATE TEMPORARY TABLE [recipe__temp__696fa5649c681] AS SELECT [cocktail_id],[ingredient_id],[amount],[measure],[variation] FROM [recipe];
DROP TABLE [recipe];

CREATE TABLE [recipe]
(
    [cocktail_id] INTEGER NOT NULL,
    [ingredient_id] INTEGER NOT NULL,
    [amount] INTEGER NOT NULL,
    [measure] INTEGER NOT NULL,
    PRIMARY KEY ([cocktail_id],[ingredient_id]),
    UNIQUE ([cocktail_id],[ingredient_id]),
    FOREIGN KEY ([ingredient_id]) REFERENCES [ingredients] ([id])
        ON DELETE CASCADE,
    FOREIGN KEY ([cocktail_id]) REFERENCES [cocktails] ([id])
        ON DELETE CASCADE
);

INSERT INTO [recipe] (measure, cocktail_id, ingredient_id, amount) SELECT measure, cocktail_id, ingredient_id, amount FROM [recipe__temp__696fa5649c681];
DROP TABLE [recipe__temp__696fa5649c681];

PRAGMA foreign_keys = ON;
EOT;

        return [
            'cocktails' => $connection_cocktails,
        ];
    }

}
