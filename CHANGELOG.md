# Changelog

All notable changes to this project will be documented in this file.

This project follows **Semantic Versioning**.

---

## [0.1.0-beta] – 2025-12-17

### Added

- Initial integration of **Lit + Rollup + TypeScript** for CodeIgniter 4.6+
- `frontend:init` command to bootstrap frontend structure
- `frontend:install` command to install NPM dependencies
- `frontend:build` command for production builds
- `frontend:dev` command for watch mode
- Automatic Rollup manifest generation
- CI4 helper `frontend_script()` for asset loading
- Sample Lit component (`x-hello`)
- Opinionated project structure for frontend assets

## [0.1.1-beta] - 2025-12-17

- Change "minimum-stability" for stable in the composer.json file

## [0.1.2-beta] - 2025-12-17

### Added

- Automatic creation of `frontend_helper.php`
- Documentation explaining how to load the helper in `BaseController`
- Usage instructions for `frontend_script()` in layout views

### Fixed

- Helper not being created during `frontend:init`
- File overwrite issue in `writeIfMissing`

### Notes

- This is the first public beta release
- API is considered stable, but minor adjustments may occur
- No breaking changes are expected before `v1.0.0`
- After updating, run `php spark frontend:init` to generate new scripts and helpers.
- Existing files are not overwritten.

## [0.1.3-beta] - 2025-12-17

### Fixed

- Fixed "app.js" in default parameter on frontend_script function in the frontend_helper() file.

## [0.1.4-beta] - 2025-12-20

### Added

- The rimraf package was installed to "clean up" the Rollup builds in the public/assets directory

## [0.1.5-beta] - 2025-12-20

### Fixed

- The rimraf package has been added to helpers/package.json
