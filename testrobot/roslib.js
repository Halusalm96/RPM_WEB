var ros = new ROSLIB.Ros({
    url: 'ws://192.168.123.118:9090'
});

ros.on('connection', function() {
    console.log('Connected to ROS');
});

ros.on('error', function(error) {
    console.log('Error connecting to ROS:', error);
});

ros.on('close', function() {
    console.log('Disconnected from ROS');
});
