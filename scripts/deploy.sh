#! /bin/bash

# Specify the path to the config file
BASE_PATH="$(dirname "$0")"
CONFIG_PATH="$BASE_PATH/.envdeploy"
DEPLOYMENT=

# Check if config file exists
if [ -e "$CONFIG_PATH" ]; then
    echo "Using $CONFIG_PATH config."
    source $CONFIG_PATH
else
    echo "$CONFIG_PATH does not exist."
    echo "Create new config based on '.envdeploy.example'."
    exit 1
fi

# Check if the script is being run as root
if [ "$(id -u)" -ne 0 ]; then
    echo "This script must be run as root."
    exit 1
fi

cd $REPO_PATH
chown -R $USER:$USER .
result=$(su - $USER << EOF
    cd $REPO_PATH
    local_head=\$(git rev-parse HEAD)
    branch_head=\$(git rev-parse $BRANCH_NAME)
    export DEPLOYMENT="True"

    if [ "\$local_head" != "\$branch_head" ]; then
        echo "Wrong branch at production!"
        echo "Changing branch to '$BRANCH_NAME'."
        git add .
        git commit -m 'WIP: Wrong branch during deployment'
        git checkout $BRANCH_NAME
        local_head=\$(git rev-parse HEAD)
    fi

    git fetch $REPO_ORIGIN $BRANCH_NAME
    branch_head=\$(git rev-parse $REPO_ORIGIN/$BRANCH_NAME)

    if [ "\$local_head" == "\$branch_head" ]; then
        echo "No new changes in the '$BRANCH_NAME' branch."
        echo "Site will not be deployed."
        exit 0
    fi

    # Get the status of the repository
    git_status=\$(git status --porcelain)

    # Check if there are any uncommitted changes
    if [ -n "\$git_status" ]; then
        echo "Uncommitted changes found. Resetting to HEAD.."
        git reset --hard HEAD
    fi

    echo "There are new changes in the '$BRANCH_NAME' branch."
    git pull $REPO_ORIGIN $BRANCH_NAME
    echo "Deploying the site..."
EOF
)
    echo $result
    if [[ $result == *"Deploying the site"* ]]; then
        make deploy
    else
        echo "No new changes. Site will not be deployed."
        chown -R systemd-resolve:systemd-journal .
    fi
