# DynaSurf - Project Instructions

## JSON Content Management

Production (cPanel) is the source of truth for `content/*.json` and uploaded images — admins edit live via the CMS.

The GitHub Action (`.github/workflows/deploy.yml`) rsyncs to cPanel with `content/` and `assets/images/uploads/` **excluded**, so pushes cannot overwrite live JSON or uploaded images. Pushing template/PHP changes is safe without first syncing JSON from production.

**Optional:** If you want GitHub to mirror production content (useful for audit/rollback), download the latest JSON and commit it separately. Not required for safety.
