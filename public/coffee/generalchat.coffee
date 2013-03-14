$(document).ready ->
	log = (msg) -> $('#log').append("#{msg}<br />")	
	userid = $('#action').val()
	serverUrl = 'ws://127.0.0.1:8000/chat?uid=' + userid
	if window.MozWebSocket		
		socket = new MozWebSocket serverUrl
	else if window.WebSocket		
		socket = new WebSocket serverUrl
	socket.binaryType = 'blob'


	socket.onopen = (msg) ->
		$('#status').removeClass().addClass('online').html('connected')


	socket.onmessage = (msg) ->
		response = JSON.parse(msg.data)
		$.ajax '/global',
			type: 'POST'
			data: {
					"action": "messaging",
					"to": response.to,
					"from": response.action,
					"message": response.data,
					
			}
			dataType: 'html'
			success: (data) ->
				$('#log').append(data);

	
	socket.onclose = (msg) ->
		$('#status').removeClass().addClass('offline').html('disconnected')
	
	$('#status').click ->
		socket.close()
	
	$('#send').click ->
		payload = new Object()
		payload.action = $('#action').val()
		payload.data = $('#data').val()
		payload.to = $('#to').val()
		socket.send(JSON.stringify(payload))
		
	$('#sendfile').click ->
		data = document.binaryFrame.file.files[0]
		if data			
			payload = new Object()
			payload.action = 'setFilename'
			payload.data = $('#file').val()			
			socket.send JSON.stringify payload			
			socket.send(data)
		return false
		