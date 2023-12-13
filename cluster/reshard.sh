#!/bin/bash

CLUSTER_HOST="127.0.0.1"
CLUSTER_PORT=7001

# Connect to any node in the cluster to get the list of nodes
CLUSTER_INFO=$(redis-cli -h "$CLUSTER_HOST" -p "$CLUSTER_PORT" cluster nodes|grep master)

# Extract node ids (assuming node ids are in the first column)
NODE_IDS=($(echo "$CLUSTER_INFO" | awk '{print $1}'))

# Randomly select a source and a target node
SOURCE_NODE=${NODE_IDS[$RANDOM % ${#NODE_IDS[@]}]}
TARGET_NODE=${NODE_IDS[$RANDOM % ${#NODE_IDS[@]}]}

# Ensure source and target are not the same
while [ "$SOURCE_NODE" == "$TARGET_NODE" ]; do
    TARGET_NODE=${NODE_IDS[$RANDOM % ${#NODE_IDS[@]}]}
done

# Number of slots to move (e.g., 10 slots)
SLOTS_TO_MOVE=100

# Perform the resharding
# Replace with the actual host and port of your Redis cluster
redis-cli --cluster reshard --cluster-yes \
    --cluster-from $SOURCE_NODE --cluster-to $TARGET_NODE \
    --cluster-slots $SLOTS_TO_MOVE \
    "$CLUSTER_HOST:$CLUSTER_PORT"

echo "Resharding complete."
