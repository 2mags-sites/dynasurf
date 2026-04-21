#!/usr/bin/env bash
# Manual deploy to dynasurf.co.uk production via rsync.
#
# Never touches:
#   content/                    JSON content edited via admin CMS
#   assets/images/uploads/      Images uploaded via admin
#
# Usage:
#   1. Copy deploy.config.example to deploy.config and fill in SSH host
#   2. ./deploy.sh

set -euo pipefail
cd "$(dirname "$0")"

if [[ ! -f deploy.config ]]; then
  echo "Error: deploy.config not found. Copy deploy.config.example to deploy.config and fill in values." >&2
  exit 1
fi

# shellcheck source=/dev/null
source deploy.config

: "${REMOTE_HOST:?REMOTE_HOST must be set in deploy.config}"
: "${REMOTE_USER:=dynasurfco}"
: "${REMOTE_PATH:=/home/dynasurfco/public_html/}"

SSH_CMD="ssh -o StrictHostKeyChecking=accept-new"
if [[ -n "${SSH_KEY:-}" ]]; then
  SSH_CMD="$SSH_CMD -i $SSH_KEY"
fi

echo "Deploying to ${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}"
echo "Excluding: content/, assets/images/uploads/, .git, .claude, deploy.*, .env*, CLAUDE.md, tmpclaude-*"
echo

rsync -avz \
  -e "$SSH_CMD" \
  --exclude='.git/' \
  --exclude='.github/' \
  --exclude='.claude/' \
  --exclude='content/' \
  --exclude='assets/images/uploads/' \
  --exclude='.env' \
  --exclude='.env.*' \
  --exclude='deploy.sh' \
  --exclude='deploy.config' \
  --exclude='deploy.config.example' \
  --exclude='CLAUDE.md' \
  --exclude='tmpclaude-*' \
  --exclude='*.md.backup' \
  ./ "${REMOTE_USER}@${REMOTE_HOST}:${REMOTE_PATH}"

echo
echo "✓ Deploy complete"
