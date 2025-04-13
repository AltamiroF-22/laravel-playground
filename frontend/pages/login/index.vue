<template>
    <div class="flex justify-center items-center min-h-[100dvh]">
        <div
            class="w-2/3 space-y-7 flex flex-col max-w-[500px] translate-y-[-40px]"
        >
            <UiFormField name="email">
                <UiFormItem>
                    <UiFormLabel>Email</UiFormLabel>
                    <UiFormControl>
                        <UiInput
                            size="lg"
                            type="email"
                            placeholder="thebookisonthetable@email.com"
                            v-model="auth.textInput.email"
                        />
                    </UiFormControl>
                </UiFormItem>
            </UiFormField>

            <UiFormField name="password">
                <UiFormItem>
                    <UiFormLabel>Senha</UiFormLabel>
                    <UiFormControl>
                        <UiInput
                            type="password"
                            placeholder="abacaxicommolhodebanana"
                            v-model="auth.textInput.password"
                        />
                    </UiFormControl>
                    <UiFormMessage />
                </UiFormItem>
            </UiFormField>

            <UiButton
                @click="handleSubmit"
                class="w-full cursor-pointer"
                size="lg"
                >Entrar</UiButton
            >
        </div>
    </div>
</template>

<script lang="ts" setup>
import { useAuth } from "@/stores/AuthStore";

const auth = useAuth();
const router = useRouter();

const handleSubmit = () => {
    auth.login();
};

watch(
    () => auth.token,
    (newToken) => {
        if (newToken) {
            router.push("/");
        }
    }
);
</script>
