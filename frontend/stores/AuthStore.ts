import { defineStore } from "pinia";
import { ref } from "vue";
import axios from "axios";

export const useAuth = defineStore(
    "auth",
    () => {
        const textInput = ref({
            email: "",
            password: "",
        });
        const token = ref<string | null>(null);
        const userId = ref<string | number | null>(null);

        const login = async () => {
            try {
                const response = await axios.post(
                    "http://127.0.0.1:8000/api/login",
                    {
                        email: textInput.value.email,
                        password: textInput.value.password,
                    }
                );

                token.value = response.data.token;
                userId.value = response.data.user.id;

                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${token.value}`;

                alert("logado!");

                return response.data;
            } catch (error: any) {
                console.error("Erro ao logar usuário:", error);
                alert("algo errado");
                return null;
            }
        };

        const logout = () => {};

        return {
            login,
            textInput,
            token,
            userId,
            logout,
        };
    },
    {
        persist: true,
    }
);
