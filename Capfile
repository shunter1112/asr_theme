role :server,  "shunter@shunter.sakura.ne.jp"

set :user,     "shunter"

task :deploy, :roles => :server do
	run "cd /home/shunter/www/asr/wp-content/themes/asr_theme && git pull --rebase"
end


