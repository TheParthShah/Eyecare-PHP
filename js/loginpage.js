function validate(form) {
				var re = /^[a-z,A-Z,0-9]+$/i;

				if (!re.test(form.username.value)) {
					alert('Please enter only numbers & letters in the user name field');
					return false;
					}
				}