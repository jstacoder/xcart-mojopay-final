#!/bin/bash

if [ -z "$PKEY" ]; then
    ssh "$@"
else
    ssh -i "$PKEY" "$@"
fi
