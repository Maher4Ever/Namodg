# A sample Guardfile
# More info at https://github.com/guard/guard#readme

guard 'phpunit', :tests_path => 'tests', :cli => '--colors --verbose' do
  watch('tests/TestHelper.php') { 'tests' }
  watch(%r{^tests/.+Test\.php$})
  watch(%r{^lib/classes/(.+)\.php$}) { |m| "tests/#{m[1]}Test.php" }
end
