import { test, expect } from '@playwright/test';

test('has title', async ({ page }) => {
  await page.goto('http://laravue.test/login');

  // Expect a title "to contain" a substring.
  await expect(page).toHaveTitle(/laravue/);
});

test('has dashboard after login', async ({ page }) => {
  await page.goto('http://laravue.test/login');
  await page.getByTestId('input.email').type('user@laravue.test');
  await page.getByTestId('input.password').type('123456');
  await page.getByTestId('button.login').click();

  const headerText = await page.getByTestId('header.dashboard').innerText();
  expect(headerText).toContain('Bonjour');
});
