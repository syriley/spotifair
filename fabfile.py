from __future__ import with_statement
from fabric.api import *

branch = "notExist"


def doDeploy(branch, env, codeDir):
    git_pull = "git pull origin " + branch
    git_checkout = "git checkout " + branch
    # copy_app_properties = 'cp %s.app.properties build/app.properties' % env.env
    # copy_wp_config = 'cp %s.wp-config.php build/wordpress-core/wp-config.php' % env.env
    with cd(codeDir):
        print("Executing on %(host)s as %(user)s" % env)
        run('git fetch')
        run(git_pull)
        run(git_checkout)
        # with cd('scripts'):
        #     run('python generateAppProperties.py')
        # run(copy_app_properties)
        # run(copy_wp_config)


def deploy():
    env.user = "spotifair"
    codeDir = '/home/spotifair/projects/spotifair'
    doDeploy(branch, env, codeDir)


def stage(b='master'):
    env.env = 'stage'
    env.hosts = ["stage.spotifair.com"]
    global branch
    branch = b


def live():
    env.env = 'live'
    env.port = 222
    env.hosts = ['spotifair.com']
    global branch
    branch = "master"


def client():
    env.env = 'clientStage'
    env.port = 222
    env.hosts = ['stage.client.spotifair.com', 'live.client.spotifair.com']
    global branch
    branch = "master"
