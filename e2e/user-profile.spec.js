import { test, expect } from '@playwright/test';

test('permissions cant be edited', async ({ page }) => {
  await page.goto('http://laravue.test/login');
  await page.getByTestId('input.email').type('user@laravue.test');
  await page.getByTestId('input.password').type('123456');
  await page.getByTestId('button.login').click();

  const headerText = await page.getByTestId('header.dashboard').innerText();
  expect(headerText).toContain('Bonjour');
  await page.getByTestId('button.profile').click();

  const sectionPermission = await page.getByTestId('section.permissions');
  await expect(sectionPermission).toBeHidden('section.permissions');
});
