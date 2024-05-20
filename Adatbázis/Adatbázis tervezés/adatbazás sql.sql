CREATE DATABASE modpackkezelo CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

USE modpackkezelo;

CREATE TABLE Modpack (
    modpack_id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    version VARCHAR(50) NOT NULL,
    completion_status VARCHAR(50) NOT NULL,
    minecraft_version_id INT,
    completed_version VARCHAR(50),
    short_description TEXT,
    target_audience VARCHAR(255),
    difficulty_level VARCHAR(50),
    creator TEXT,
    FOREIGN KEY (minecraft_version_id) REFERENCES MinecraftVersions (minecraft_version_id)
);

CREATE TABLE Mods (
    mod_id INT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    version VARCHAR(50) NOT NULL
);

CREATE TABLE ModpackMods (
    modpack_id INT,
    mod_id INT,
    PRIMARY KEY (modpack_id, mod_id),
    FOREIGN KEY (modpack_id) REFERENCES Modpack (modpack_id),
    FOREIGN KEY (mod_id) REFERENCES Mods (mod_id)
);

CREATE TABLE MinecraftVersions (
    minecraft_version_id INT PRIMARY KEY,
    version_name VARCHAR(50) NOT NULL,
    release_date DATE
);