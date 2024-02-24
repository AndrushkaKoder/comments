let comments = document.querySelectorAll('.comment');
if (comments) {
	commentsFunc(comments);
}


function commentsFunc(comments) {
	comments.forEach((el) => {
		el.addEventListener('click', (event) => {
			if (event.target.hasAttribute('data-delete')) {
				let commentId = el.getAttribute('data-comment');
				console.log(commentId);
				if (commentId && confirm('Комментарий будет удален, продолжить?')) {
					event.stopPropagation();
					sendAjax('/comments/remove', {id: commentId}, 'POST')
					el.remove();
				}
			}
			if (event.target.hasAttribute('data-edit')) {
				event.stopPropagation();
				setInputForm(el, '/comments/edit', 'Изменить комментарий')
			}

			if (event.target.hasAttribute('data-answer')) {
				event.stopPropagation();
				setInputForm(el, '/comments/answer', 'Ответить на комментарий', false)
			}

		})
	})
}

function sendAjax(url, data, httpMethod = 'POST') {
	let formData = new FormData();
	formData.append('post_id', data.id);
	let xhr = new XMLHttpRequest();
	xhr.open(httpMethod, url, true);
	xhr.onload = () => {
		console.log('success')
	}
	xhr.onerror = () => {
		console.error('error')
	}
	xhr.send(formData);
}

function setInputForm(comment, formUrl, formTitle, isEdit = true) {
	let commentForm = document.querySelector('.comment_form');
	let content = comment.querySelector('.comment_content > p');
	let title = commentForm.querySelector('h5');
	title.innerText = formTitle;
	let commentInputField = commentForm.querySelector('.comment_input');

	if (isEdit) {
		commentInputField.value = content.innerText;
	} else {
		title.innerText = title.innerText + " - " + content.innerText;
		console.log(title.value)
	}

	commentForm.setAttribute('action', formUrl);
	let commentIdValue = document.createElement('INPUT');
	commentIdValue.setAttribute('type', 'hidden');
	commentIdValue.setAttribute('name', 'comment_id');
	commentIdValue.value = comment.getAttribute('data-comment');
	commentForm.append(commentIdValue);
}

