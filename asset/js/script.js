const sendFormData = async (formId, successRedirect, errorId, url='controller/auth-controller.php') => {
    const form = document.getElementById(formId);
    if (form) {
      form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        try {
          const response = await fetch(url, {
            method: 'POST',
            body: formData,
          });
          if (response.ok) {
            const text = await response.text();
            if (text === 'success') {
                if(successRedirect !== null){
                     window.location.href = successRedirect;
                }else{
                    document.getElementById(errorId).innerHTML = text;
                }
            } else {
              document.getElementById(errorId).innerHTML = text;
            }
          } else {
            console.log('Error: ' + response.status);
          }
        } catch (error) {
          console.log('Error: ' + error);
        }
      });
    }
  };
  
  sendFormData('login-form', 'dashboard', 'login-error');
  sendFormData('signup-form', 'login', 'signup-error');
  sendFormData('password-form', null, 'change-password-error');
  sendFormData('forgot-form', 'login', 'forgot-error', 'controller/email.php');
  sendFormData('reset-form', 'login', 'reset-error', 'controller/email.php');
  sendFormData('profile-form', 'account', 'profile-error');
  sendFormData('update-form', 'account', 'update-error');
  
  const image = document.getElementById('image');
  if (image) {
    image.addEventListener('change', async (event) => {
      event.preventDefault();
      const formData = new FormData(document.getElementById('profile-form'));
      const url = 'controller/auth-controller.php';
      try {
        const response = await fetch(url, {
          method: 'POST',
          body: formData,
          headers: {
            Accept: 'multipart/form-data',
          },
        });
        if (response.ok) {
          const text = await response.text();
          if (text === 'success') {
            window.location.href = 'account';
          } else {
            document.getElementById('profile-error').innerHTML = text;
          }
        } else {
          console.log('Error: ' + response.status);
        }
      } catch (error) {
        console.log('Error: ' + error);
      }
    });
  }
  