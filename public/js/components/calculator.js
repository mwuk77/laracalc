var expression = '';
var stack = [''];
var stack_index = 0;
var display = '';
var operator_count = 0;
var api_token = '';
var api_base  = '';
var uid = '';
var pass = '';
var keys = '';

var csrf_token = document.head.querySelector('meta[name="csrf-token"]');
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf_token.content;

function setKeys(keys) {
    this.keys = keys;
}
function setCreds(id, pw) {
    uid = id;
    pass = pw;
}

function setApiBase(base) {
    api_base  = base;
}

function bindKeys(keyboardJS) {
        
    keyboardJS.bind('enter', (e) => {
        handleKeypress({key:'='});
    });
    
    for (index = 0; index < keys.length; ++index) {

        keyboardJS.bind(keys[index], (e) => {
            handleKeypress(e);
        });

        keyboardJS.bind('num' + keys[index], (e) => {
            handleKeypress(e);
        });       


        document.querySelector('[data-key="' + keys[index] + '"]')
            .addEventListener('click', function(e){
                toggleActive(e.srcElement.dataset.key);
                handleButton(e.srcElement.dataset.key);
            }
        );
    }
}

function updateDisplay(display) {
    if(display === '') {
        display = '0';
    }

    document.getElementsByClassName('display')[0].setAttribute("value", display);
}

function clear() {
    expression = '';
    stack = [''];
    stack_index = 0;
    display = '';     
    operator_count = 0;
    updateDisplay(display);
}

function handleButton(key) {
    if(key === 'C') {
        clear();
        return;
    }

    if(key === '=' && stack[stack_index] !==  '') {
        getResult(expression, api_token);
        clear();
        return;
    }

    if(key !== '=') {
        if(stack_index === 0 
                && isNaN(key) 
                && key !== '.' 
                && stack[stack_index] === '') {
            return;
        }
        expression += key;

        if(isNaN(key)  && key !== '.'){
            operator_count ++;

            stack_index ++;

            stack[stack_index] = key;

            stack_index ++;

            stack[stack_index] = '';

            if(operator_count >= 2) {
                getResult(expression, api_token);
            }
        } else {
            stack[stack_index] += key;
            display = stack[stack_index];
        }

    } 
    
    updateDisplay(display);
}

function getToken() {
    axios.post(api_base + "/login",{
        email: uid,
        password: pass
    }).then((response)=>{
        api_token = response.data.data.api_token;
    }).catch((error)=>{
        console.log(error.response.data);
    });       
}

function getResult(expression, api_token) {
    axios.post(api_base + "/operation",{
        expression: expression,
        api_token: api_token
    }).then((response)=>{
        clear();
        processResult(response.data.result);
    }).catch((error)=>{
        console.log(error.response.data);
    });
}

function processResult(result) {
    clear();
    display = result;
    expression = result;
    stack[stack_index] = result;
    updateDisplay(display);
}

function toggleActive(key) {
    document.querySelector('[data-key="' + key + '"]').classList.add('active');
    setTimeout(function(){
        document.querySelector('[data-key="' + key + '"]').classList.remove('active');
    }, 500, key);        
}

function handleKeypress(kjsKey) {
    if(keys.indexOf(kjsKey.key) === -1) {
        updateDisplay(':-(');
        return;
    }
    if(kjsKey === 'Enter') {
         document.querySelector('[data-key="="]').click();
         return;
    }
    document.querySelector('[data-key="'+ kjsKey.key + '"]').click();
}