Feature: presentation
  Opening the / file an user view the presentation cover
  As a user with a browser
  I need to see the presentation cover

  Scenario: Can find the title
    Given I am on "/"
    Then the response status code should be 200
    Then the response should contain "Presentation Test"
