let comments = document.querySelectorAll('.comment');
if (comments) {
	commentsFunc(comments);
}

function commentsFunc(comments) {
	comments.forEach((el) => {
		el.addEventListener('click', (event) => {
			if (event.target.hasAttribute('data-delete')) {
				let commentId = el.getAttribute('data-post');
				if (commentId && confirm('Комментарий будет удален, продолжить?')) {
					sendAjax('/comments/remove', {id: commentId})
					el.remove();
				}
			}
			if (event.target.hasAttribute('data-edit')) {
				createCommentForm(el);
			}

			if (event.target.hasAttribute('data-answer')) {
				createCommentForm(el, false);
			}

		})
	})
}

function sendAjax(url, data, httpMethod = 'POST') {
	fetch(url, {
		method: httpMethod, body: JSON.stringify(data)
	}).then(function (response) {
		console.log(response.json())
	}).catch(function (response) {
		console.log(response.status)
	});
}

function createCommentForm(wrapper, edit = true) {

	let form = document.createElement('FORM');
	form.setAttribute('method', 'post');
	form.setAttribute('action', edit ? '/comments/edit' : '/comments/answer');


	let input = document.createElement('INPUT');
	input.setAttribute('name', edit ? 'comment_edit' : 'comment_answer');
	input.setAttribute('type', 'text');
	input.classList.add('form-control');
	if (edit) {
		input.value = wrapper.querySelector('.comment_content').innerText;
	}

	let inputCommentId = document.createElement('INPUT');
	inputCommentId.setAttribute('type', 'hidden');
	inputCommentId.setAttribute('name', 'comment_id');
	inputCommentId.value = wrapper.getAttribute('data-comment');

	let inputPostId = document.createElement('INPUT');
	inputPostId.setAttribute('type', 'hidden');
	inputPostId.setAttribute('name', 'post_id');
	inputPostId.value = wrapper.getAttribute('data-post');
	let editButton = document.createElement('BUTTON');
	editButton.setAttribute('type', 'submit');
	editButton.classList.add('btn');
	editButton.classList.add('btn-success');
	editButton.textContent = edit ? 'Изменить' : 'Ответить';

	form.append(input);
	form.append(editButton);
	form.append(inputCommentId);
	form.append(inputPostId);

	wrapper.append(form);
}
