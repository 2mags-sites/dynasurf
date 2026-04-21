# DynaSurf - Project Instructions

## Deploy Workflow

**Deploys are manual from local via rsync.** No GitHub Actions, no CI.

To deploy template/PHP changes to production (`dynasurf.co.uk`):

```bash
./deploy.sh
```

`deploy.sh` runs rsync with these paths **always excluded** — they must never be overwritten:

- `content/` — JSON content edited live via the admin CMS (production is source of truth)
- `assets/images/uploads/` — images uploaded via admin
- `.git/`, `.github/`, `.claude/`, `.env*`, `CLAUDE.md`, `deploy.*` — local/config files

## One-time setup

Copy `deploy.config.example` to `deploy.config` and fill in the SSH host. `deploy.config` is gitignored.

## GitHub

GitHub is optional backup only — nothing deploys from it. Push if you want history/backup; skip if you don't. Stale JSON in GitHub is harmless because the repo doesn't touch production.
