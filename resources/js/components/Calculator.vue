
<template>
     
    <div class="calculator">
        <input :value="display" class="display" type="text" disabled="disabled">
        <div class="buttons">
            <button 
                v-for="button in buttons"
                @click="handleButton({button})"
                :key="button"
                :data-key="button"
            >{{ button }}</button>
        </div>      
    </div>

</template>

<script>
    export default {
        name: 'calculator',

        props: ['buttons', 'apiBase', 'displayLength', 'id','pw'],
        
        data (){
            return {
                display: '0',
                stack: [''],
                stackIndex: 0,
                expression: '',
                apiToken: '',
                operators: ['+', '-', '*', '/'],
                operatorCount: 0
            }
        },

        mounted() {
            this.display = '0'
            this.getToken()
            this.bindKeys()
        },

        watch: {
            display: function (newVal) {
                if(newVal === '0.') {
                    newVal = '0.0'
                }
                this.display = Number.parseFloat(newVal).toPrecision(parseInt(this.displayLength))             
            }
        },

        methods:{
            bindKeys() {
                window.addEventListener("keypress", e => {
                    this.handleKeypress(e.keyCode)
                })
            },

            handleKeypress(keyCode) {
         
                var key =  String.fromCharCode(keyCode)
                
                //enter key
                if(keyCode === 13) {
                    document.querySelector('[data-key="="]').click()
                    return
                }

                //delete key
                if(keyCode === 127) {
                    document.querySelector('[data-key="C"]').click()
                    return
                }

                //invalid key
                if(this.buttons.indexOf(key) === -1) {
                    this.display =  ':-('
                    return
                }


                document.querySelector('[data-key="'+ key + '"]').click()
            },

            isOperator(key) {
                if(this.operators.indexOf(key) !== -1) {
                    return true
                }

                return false
            },

            handleButton(key) {
                key = key.button

                this.toggleActive(key)

                if(key === 'C') {
                    this.clear()
                    return
                }

                if(key === '=' 
                    && this.stack[this.stackIndex] !==  ''
                    ) {
                    this.getResult(this.expression, this.apiToken)
                    this.clear()
                    return
                }

                if(key !== '=') {
                    //expressions can't start with operators
                    if(this.stackIndex === 0 
                            && this.isOperator(key)
                            && this.stack[this.stackIndex] === '') {
                        return
                    }

                    //add leading zero to number beginning with '.'
                    if(key === '.' && this.stack[this.stackIndex] === '') {
                        key = '0.'
                    }

                    this.expression += key;

                    if(this.isOperator(key)
                        && ! this.isOperator(this.stack[this.stackIndex])) {
                        this.operatorCount ++

                        this.stackIndex ++

                        this.stack[this.stackIndex] = key

                        this.stackIndex ++

                        this.stack[this.stackIndex] = ''

                        if(this.operatorCount >= 2) {
                            var exp  =  this.expression

                            //remove hanging operator
                            if(this.isOperator(this.stack[this.stackIndex - 1]))  {
                                exp = this.expression.substring(0, this.expression.length - 1)
                            }
                            this.getResult(
                                exp, 
                                this.apiToken
                            )
                        }
                    } else {
                        //numeric
                        this.stack[this.stackIndex] += key
                                                
                        this.display = this.stack[this.stackIndex]
                    }

                }             
            },

            clear() {
                this.expression = ''
                this.stack = ['']
                this.stackIndex = 0
                this.display = '0'
                this.operatorCount = 0
            },

            getToken() {
                axios.post(this.apiBase + "/login",{
                    email: this.id,
                    password: this.pw
                }).then((response)=>{
                    this.apiToken = response.data.data.api_token;
                }).catch((error)=>{
                    this.display = 'error'
                    console.log(error.response.data);
                });       
            },

            getResult(expression, apiToken) {
                axios.post(this.apiBase + "/operation",{
                    expression: expression,
                    api_token: apiToken
                }).then((response)=>{
                    this.clear()
                    this.processResult(response.data.result)
                }).catch((error)=>{
                    console.log(error)
                })
            },
            
            processResult(result) {
                this.clear()
                this.display = result
                this.expression = result
                this.stack[this.stackIndex] = result   
                this.stackIndex++;
                this.stack[this.stackIndex] = ''            
            },

            toggleActive(key) {
                document.querySelector('[data-key="' + key + '"]').classList.add('active')
                setTimeout(function(){
                    document.querySelector('[data-key="' + key + '"]').classList.remove('active')
                }, 500, key)     
            }            
        }
    }
</script>